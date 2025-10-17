<?php

namespace PurchaseOrder\Http\Requests\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sku' => 'required|string|unique:products,sku',
            'barcode' => 'nullable|string',
            'original_price' => 'nullable|numeric',
            'cost_price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'is_sale' => 'nullable|boolean',
            'stock_quantity' => 'nullable|integer',
            'tax_rate' => 'nullable|numeric',
            'is_taxable' => 'nullable|boolean',
            'unit' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'brand_id' => 'nullable|integer|exists:brands,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'currency_code' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'description' => 'nullable|string',
        ];
    }
}
