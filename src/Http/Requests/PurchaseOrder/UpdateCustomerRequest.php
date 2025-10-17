<?php

namespace PurchaseOrder\Http\Requests\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $customerId = $this->user() ? $this->user()->id : null;

        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:customers,email,' . $customerId,
            'phone' => 'sometimes|phone|unique:customers,phone,' . $customerId,
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }
}
