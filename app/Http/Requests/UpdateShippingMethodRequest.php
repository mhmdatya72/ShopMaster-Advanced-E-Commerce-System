<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingMethodRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'cost' => 'sometimes|numeric|min:0',
            'estimated_days' => 'sometimes|integer|min:1',
            'is_active' => 'sometimes|boolean'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.max' => 'Shipping method name cannot exceed 255 characters.',
            'cost.numeric' => 'Shipping cost must be a number.',
            'cost.min' => 'Shipping cost must be at least 0.',
            'estimated_days.integer' => 'Estimated days must be an integer.',
            'estimated_days.min' => 'Estimated days must be at least 1.',
            'is_active.boolean' => 'Active status must be true or false.'
        ];
    }
}
