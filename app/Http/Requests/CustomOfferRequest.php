<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomOfferRequest extends FormRequest
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
            'percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'sync_interval' => ['required', 'integer', 'min:1', 'max:100']
        ];
    }

    public function messages(): array
    {
        return [
            'percentage.required' => 'Please enter a percentage value.',
            'percentage.numeric' => 'Percentage must be a number.',
            'percentage.min' => 'Percentage must be greater than or equal to 0.',
            'percentage.max' => 'Percentage must be less than or equal to 100.',

            // Sync interval messages
            'sync_interval.required' => 'Please enter sync interval hours.',
            'sync_interval.integer' => 'Sync interval must be a whole number.',
            'sync_interval.min' => 'Sync interval must be at least 1 hour.',
            'sync_interval.max' => 'Sync interval cannot exceed 100 hours.',
        ];
    }
}
