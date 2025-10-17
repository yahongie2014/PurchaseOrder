<?php

namespace PurchaseOrder\Http\Controllers\PurchaseOrder\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use PurchaseOrder\Http\Requests\PurchaseOrder\StoreOrderRequest;
use PurchaseOrder\Http\Resources\OrderResource;
use PurchaseOrder\Repositories\Contracts\OrderRepositoryInterface;
use App\Models\PurchaseOrder\OrderItem;
use App\Models\PurchaseOrder\Order;

class OrderApiController extends Controller
{
    protected OrderRepositoryInterface $repo;

    public function __construct(OrderRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        $order = null;

        DB::transaction(function () use ($data, &$order) {
            $items = $data['items'];
            unset($data['items']);

            $order = $this->repo->create($data);

            foreach ($items as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }
        });

        $order->load(['items', 'payments', 'user', 'cashier', 'customer']);

        return response(new OrderResource($order), 201);
    }

    public function track($identifier)
    {
        $order = Order::where('order_number', $identifier)->orWhere('id', $identifier)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        $data = [
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'shipping_status' => $order->shipping_status ?? null,
            'tracking_number' => $order->tracking_number ?? null,
            'estimated_delivery' => $order->estimated_delivery ?? null,
        ];

        return response()->json($data);
    }
}
