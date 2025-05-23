<?php

namespace PurchaseOrder\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashierResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_id' => $this->user->name,
            'is_active' => $this->is_active,
            'last_login_at' => $this->last_login_at,
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
