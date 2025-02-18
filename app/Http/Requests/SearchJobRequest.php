<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchJobRequest extends FormRequest
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
            'name' => 'nullable|string|min:2|max:100',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'country' => 'nullable|string|min:2|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'The name must be a string.',
            'name.min' => 'The name must be at least 3 characters long.',
            'name.max' => 'The name must not exceed 100 characters.',
            'salary_min.numeric' => 'The minimum salary must be a number.',
            'salary_min.min' => 'The minimum salary cannot be negative.',
            'salary_max.numeric' => 'The maximum salary must be a number.',
            'salary_max.min' => 'The maximum salary cannot be negative.',
            'salary_max.gte' => 'The maximum salary must be greater than or equal to the minimum salary.',
            'country.string' => 'The country must be a string.',
            'country.min' => 'The country must be at least 2 characters long.',
            'country.max' => 'The country must not exceed 100 characters.',
        ];
    }
}
