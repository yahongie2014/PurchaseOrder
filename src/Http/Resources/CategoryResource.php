<?php

namespace PurchaseOrder\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'is_active' => $this->is_active,
            'cover_img_url' => $this->cover_img_url,
            'name' => $this->name,
            'description' => $this->description,
            'details' => CategoryDetailResource::collection($this->whenLoaded('details')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
