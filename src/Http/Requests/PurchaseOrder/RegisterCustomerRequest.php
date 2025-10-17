<?php

namespace PurchaseOrder\Http\Requests\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|phone|unique:customers,phone',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
