<?php

namespace PurchaseOrder\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'barcode' => $this->barcode,
            'original_price' => $this->original_price,
            'cost_price' => $this->cost_price,
            'sale_price' => $this->sale_price,
            'is_sale' => $this->is_sale,
            'stock_quantity' => $this->stock_quantity,
            'tax_rate' => $this->tax_rate,
            'is_taxable' => $this->is_taxable,
            'unit' => $this->unit,
            'unit_translated' => $this->unit_translated,
            'weight' => $this->weight,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'images' => ProductImageResource::collection($this->whenLoaded('images')),
            'tags' => $this->tags,
            'cover_img_url' => $this->cover_img_url,
            'synced_at' => $this->synced_at,
            'is_active' => $this->is_active,
            'description' => $this->description,
        ];
    }
}
