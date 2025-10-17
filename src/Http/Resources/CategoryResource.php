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
            'name' => $this->getName($request->get('locale', app()->getLocale())),
            'description' => $this->getDescription($request->get('locale', app()->getLocale())),
            'is_active' => $this->is_active,
            'details' => CategoryDetailResource::collection($this->whenLoaded('details')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'cover_img_url' => $this->cover_img_url ? asset('storage/categories/' . $this->cover_img_url) : null,
        ];
    }
}
