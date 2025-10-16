<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'shipping_address' => 'required|array',
            'shipping_address.first_name' => 'required|string|max:255',
            'shipping_address.last_name' => 'required|string|max:255',
            'shipping_address.email' => 'required|email|max:255',
            'shipping_address.phone' => 'required|string|max:20',
            'shipping_address.address' => 'required|string|max:500',
            'shipping_address.city' => 'required|string|max:100',
            'shipping_address.state' => 'required|string|max:100',
            'shipping_address.postal_code' => 'required|string|max:20',
            'shipping_address.country' => 'required|string|max:100',
            
            'billing_address' => 'required|array',
            'billing_address.first_name' => 'required|string|max:255',
            'billing_address.last_name' => 'required|string|max:255',
            'billing_address.email' => 'required|email|max:255',
            'billing_address.phone' => 'required|string|max:20',
            'billing_address.address' => 'required|string|max:500',
            'billing_address.city' => 'required|string|max:100',
            'billing_address.state' => 'required|string|max:100',
            'billing_address.postal_code' => 'required|string|max:20',
            'billing_address.country' => 'required|string|max:100',
            
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'coupon_code' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'shipping_address.required' => 'Shipping address is required.',
            'shipping_address.first_name.required' => 'Shipping first name is required.',
            'shipping_address.last_name.required' => 'Shipping last name is required.',
            'shipping_address.email.required' => 'Shipping email is required.',
            'shipping_address.email.email' => 'Shipping email must be a valid email address.',
            'shipping_address.phone.required' => 'Shipping phone is required.',
            'shipping_address.address.required' => 'Shipping address is required.',
            'shipping_address.city.required' => 'Shipping city is required.',
            'shipping_address.state.required' => 'Shipping state is required.',
            'shipping_address.postal_code.required' => 'Shipping postal code is required.',
            'shipping_address.country.required' => 'Shipping country is required.',
            
            'billing_address.required' => 'Billing address is required.',
            'billing_address.first_name.required' => 'Billing first name is required.',
            'billing_address.last_name.required' => 'Billing last name is required.',
            'billing_address.email.required' => 'Billing email is required.',
            'billing_address.email.email' => 'Billing email must be a valid email address.',
            'billing_address.phone.required' => 'Billing phone is required.',
            'billing_address.address.required' => 'Billing address is required.',
            'billing_address.city.required' => 'Billing city is required.',
            'billing_address.state.required' => 'Billing state is required.',
            'billing_address.postal_code.required' => 'Billing postal code is required.',
            'billing_address.country.required' => 'Billing country is required.',
            
            'shipping_method_id.required' => 'Shipping method is required.',
            'shipping_method_id.exists' => 'Selected shipping method does not exist.',
            'coupon_code.string' => 'Coupon code must be a string.',
            'coupon_code.max' => 'Coupon code must not exceed 50 characters.',
            'notes.string' => 'Notes must be a string.',
            'notes.max' => 'Notes must not exceed 1000 characters.',
        ];
    }
}
