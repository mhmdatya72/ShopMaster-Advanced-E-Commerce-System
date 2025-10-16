<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShippingMethodRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'estimated_days' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Shipping method name is required.',
            'name.max' => 'Shipping method name cannot exceed 255 characters.',
            'cost.required' => 'Shipping cost is required.',
            'cost.numeric' => 'Shipping cost must be a number.',
            'cost.min' => 'Shipping cost must be at least 0.',
            'estimated_days.required' => 'Estimated days is required.',
            'estimated_days.integer' => 'Estimated days must be an integer.',
            'estimated_days.min' => 'Estimated days must be at least 1.',
            'is_active.boolean' => 'Active status must be true or false.'
        ];
    }
}
