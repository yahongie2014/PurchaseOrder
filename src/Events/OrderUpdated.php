<?php

namespace PurchaseOrder\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use PurchaseOrder\Models\Order;

class OrderUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function broadcastOn()
    {
        return new Channel(config('purchaseorder.redis.channel_orders'));
    }

    public function broadcastWith()
    {
        return [
            'order' => $this->order->toArray(),
        ];
    }
}
