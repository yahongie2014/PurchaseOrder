<?php

namespace PurchaseOrder\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'logo_url' => $this->logo ? asset('storage/brands/' . $this->logo) : null,
            'is_active' => (bool) $this->is_active,
            'translation' => $this->translation,
            'name' => $this->getName($request->get('locale', app()->getLocale())),
            'description' => $this->getDescription($request->get('locale', app()->getLocale())),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
