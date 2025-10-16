<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
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
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'estimated_days' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Shipping method name is required.',
            'name.max' => 'Shipping method name must not exceed 255 characters.',
            'cost.required' => 'Cost is required.',
            'cost.numeric' => 'Cost must be a number.',
            'cost.min' => 'Cost must be at least 0.',
            'estimated_days.required' => 'Estimated days is required.',
            'estimated_days.integer' => 'Estimated days must be an integer.',
            'estimated_days.min' => 'Estimated days must be at least 1.',
        ];
    }
}
