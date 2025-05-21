<?php

namespace PurchaseOrder\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PurchaseOrder\Models\Product;
use PurchaseOrder\Models\Order;
use PurchaseOrder\Models\OrderItem;
use PurchaseOrder\Models\Customer;

class SimulateController extends Controller
{
    // Middleware to require login for all routes here
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show all products page
    public function products()
    {
        $products = Product::all();
        return view('purchaseorder::simulate.products', compact('products'));
    }

    // Show current user orders page
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->with('items')->get();
        return view('purchaseorder::simulate.orders', compact('orders'));
    }

    // Add product to cart (simulate a session cart)
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, (int)$request->input('quantity', 1));

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Show checkout page with cart details
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('purchaseorder::simulate.checkout', compact('products', 'cart'));
    }

    // Process checkout: create order, order items, clear cart
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('simulate.products')->withErrors('Cart is empty.');
        }

        $customer = Customer::firstOrCreate(
            ['user_id' => Auth::id()],
            ['name' => Auth::user()->name, 'email' => Auth::user()->email]
        );

        $order = Order::create([
            'customer_id' => $customer->id,
            'total' => 0, // will update below
            'status' => 'pending',
            'order_date' => now(),
        ]);

        $total = 0;

        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if (!$product) continue;

            $price = $product->price ?? 0;
            $lineTotal = $price * $qty;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $price,
                'total' => $lineTotal,
            ]);

            $total += $lineTotal;
        }

        $order->update(['total' => $total]);

        // Clear cart
        session()->forget('cart');

        return redirect()->route('simulate.orders')->with('success', 'Order placed successfully!');
    }
}
