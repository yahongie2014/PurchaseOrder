<?php

namespace PurchaseOrder\Http\Requests\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order_number' => 'required|string|unique:orders,order_number',
            'user_id' => 'nullable|integer|exists:users,id',
            'cashier_id' => 'nullable|integer|exists:cashiers,id',
            'customer_id' => 'nullable|integer|exists:customers,id',
            'subtotal' => 'required|numeric',
            'discount_amount' => 'nullable|numeric',
            'tax_amount' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'nullable|numeric',
            'payment_status' => 'required|string',
            'source' => 'nullable|string',
            'invoice_number' => 'nullable|string',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit_price' => 'required|numeric',
            'items.*.tax_amount' => 'nullable|numeric',
        ];
    }
}
