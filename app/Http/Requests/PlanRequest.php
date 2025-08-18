<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // You can adjust authorization logic here if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $planId = $this->route('plan') ? $this->route('plan')->id : null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('plans', 'slug')->ignore($planId),
            ],
            'description' => ['nullable', 'string'],
            'monthly_price' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'yearly_price' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'monthly_download_limit' => ['nullable', 'integer', 'min:0'],
            'yearly_download_limit' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'is_custom' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'plan name',
            'slug' => 'plan slug',
            'monthly_price' => 'monthly price',
            'yearly_price' => 'yearly price',
            'monthly_download_limit' => 'monthly download limit',
            'yearly_download_limit' => 'yearly download limit',
            'is_active' => 'active status',
            'is_custom' => 'custom plan status',
        ];
    }

    
}