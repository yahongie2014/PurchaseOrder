<?php

namespace PurchaseOrder\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchaseOrder\Product;
use App\Models\PurchaseOrder\Order;
use App\Models\PurchaseOrder\OrderItem;
use App\Models\PurchaseOrder\Customer;

class SimulateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function products()
    {
        $products = Product::where('is_active', true)->get();
        return view('purchaseorder::simulate.products', compact('products'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();
        return view('purchaseorder::simulate.orders', compact('orders'));
    }

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:1000',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock_quantity < $validated['quantity']) {
            return redirect()->back()->withErrors('Insufficient stock available.');
        }

        $cart = session()->get('cart', []);
        $productId = $validated['product_id'];

        if (isset($cart[$productId])) {
            $cart[$productId] += $validated['quantity'];
        } else {
            $cart[$productId] = $validated['quantity'];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('simulate.products')
                ->withErrors('Cart is empty.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('purchaseorder::simulate.checkout',
            compact('products', 'cart'));
    }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('simulate.products')
                ->withErrors('Cart is empty.');
        }

        try {
            return DB::transaction(function () use ($cart) {
                $customer = Customer::firstOrCreate(
                    ['email' => Auth::user()->email],
                    [
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'phone' => Auth::user()->phone ?? null,
                    ]
                );

                $order = Order::create([
                    'order_number' => 'ORD-' . time(),
                    'user_id' => Auth::id(),
                    'customer_id' => $customer->id,
                    'subtotal' => 0,
                    'total_amount' => 0,
                    'payment_status' => 'pending',
                    'source' => 'web',
                ]);

                $subtotal = 0;
                $taxAmount = 0;

                foreach ($cart as $productId => $qty) {
                    $product = Product::lockForUpdate()->find($productId);

                    if (!$product || $product->stock_quantity < $qty) {
                        throw new \Exception("Product {$productId} out of stock");
                    }

                    $unitPrice = $product->sale_price ?? $product->original_price;
                    $lineSubtotal = $unitPrice * $qty;
                    $lineTax = $product->is_taxable
                        ? ($lineSubtotal * $product->tax_rate / 100)
                        : 0;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'qty' => $qty,
                        'unit_price' => $unitPrice,
                        'tax_amount' => $lineTax,
                        'total_price' => $lineSubtotal + $lineTax,
                    ]);

                    $product->decrement('stock_quantity', $qty);
                    $subtotal += $lineSubtotal;
                    $taxAmount += $lineTax;
                }

                $order->update([
                    'subtotal' => $subtotal,
                    'tax_amount' => $taxAmount,
                    'total_amount' => $subtotal + $taxAmount,
                ]);

                session()->forget('cart');

                return redirect()->route('simulate.orders')
                    ->with('success', 'Order placed successfully!');
            });
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors('Failed to process order: ' . $e->getMessage());
        }
    }
}
