<?php

namespace PurchaseOrder\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $this->logo,
            'is_active' => $this->is_active,
            'details' => BrandDetailResource::collection($this->whenLoaded('details')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
