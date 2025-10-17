<?php

namespace PurchaseOrder\Http\Requests\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;

class LoginCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|string',
        ];
    }
}
