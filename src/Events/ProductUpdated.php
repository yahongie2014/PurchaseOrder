<?php

namespace PurchaseOrder\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use PurchaseOrder\Models\Product;

class ProductUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function broadcastOn()
    {
        return new Channel(config('purchaseorder.redis.channel_products'));
    }

    public function broadcastWith()
    {
        return [
            'product' => $this->product->toArray(),
        ];
    }
}
