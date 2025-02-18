<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveJobRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'modality' => ['required', 'string', 'in:remote,hybrid,presential,part-time,full-time'],
            'skills' => ['nullable', 'string', 'regex:/^[\w\s,]+$/'],
            'created_at' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'salary' => ['nullable', 'numeric', 'min:0'],
            'country' => ['required', 'string', 'min:2', 'max:100']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a valid text.',
            'name.max' => 'The name must not exceed 100 characters.',

            'company.required' => 'The company name is required.',
            'company.string' => 'The company name must be a valid text.',
            'company.max' => 'The company name must not exceed 255 characters.',

            'location.required' => 'The location is required.',
            'location.string' => 'The location must be a valid text.',
            'location.max' => 'The location must not exceed 255 characters.',

            'description.string' => 'The description must be a valid text.',

            'modality.required' => 'The modality is required.',
            'modality.string' => 'The modality must be a valid text.',
            'modality.in' => 'The modality must be one of the following options: remote, hybrid, presential, part-time, full-time.',

            'salary.numeric' => 'The minimum salary must be a number.',
            'salary.min' => 'The minimum salary cannot be negative.',

            'skills.string' => 'The skills must be a valid text.',
            'skills.regex' => 'The skills format is incorrect. Use words separated by commas.',

            'country.required' => 'The country is required.',
            'country.string' => 'The country must be a valid text.',
            'country.min' => 'The country must be at least 2 characters long.',
            'country.max' => 'The country must not exceed 100 characters.',

            'created_at.date_format' => 'The creation date must be in the format YYYY-MM-DD HH:MM:SS.',
        ];
    }
}
