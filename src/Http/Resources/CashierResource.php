<?php

namespace PurchaseOrder\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashierResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_id' => $this->user_id,
            'is_active' => $this->is_active,
            'last_login_at' => $this->last_login_at,
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
