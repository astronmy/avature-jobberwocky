<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSubscriptorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'alert_method' => ['required', 'string', 'in:email,sms,push'],
            'job_preferences' => ['required', 'array'],
            'job_preferences.job_name' => ['nullable', 'string', 'max:100'],
            'job_preferences.salary_min' => ['nullable', 'numeric', 'min:0'],
            'job_preferences.salary_max' => ['nullable', 'numeric', 'min:0'],
            'job_preferences.country' => ['nullable', 'array'],
            'job_preferences.country.*' => ['string', 'min:2', 'max:100'],
            'job_preferences.modality' => ['nullable', 'array'],
            'job_preferences.modality.*' => ['string', 'in:remote,hybrid,presential,part-time,full-time'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a valid text.',
            'name.max' => 'The name must not exceed 255 characters.',

            'email.required' => 'The email is required.',
            'email.email' => 'The email format is invalid.',
            'email.unique' => 'This email is already registered.',

            'alert_method.required' => 'The notification method is required.',
            'alert_method.string' => 'The notification method must be a valid text.',
            'alert_method.in' => 'The notification method must be one of: email, sms, push.',

            'job_preferences.required' => 'The alert preferences are required.',
            'job_preferences.array' => 'The alert preferences must be an array.',

            'job_preferences.job_title.string' => 'The job title must be a valid text.',
            'job_preferences.job_title.max' => 'The job title must not exceed 100 characters.',

            'job_preferences.salary_min.numeric' => 'The minimum salary must be a number.',
            'job_preferences.salary_min.min' => 'The minimum salary cannot be negative.',

            'job_preferences.salary_max.numeric' => 'The maximum salary must be a number.',
            'job_preferences.salary_max.min' => 'The maximum salary cannot be negative.',

            'job_preferences.country.array' => 'The country field must be an array.',
            'job_preferences.country.*.string' => 'Each country must be a valid text.',
            'job_preferences.country.*.min' => 'Each country must be at least 2 characters long.',
            'job_preferences.country.*.max' => 'Each country must not exceed 100 characters.',

            'job_preferences.modality.array' => 'The modality field must be an array.',
            'job_preferences.modality.*.string' => 'Each modality must be a valid text.',
            'job_preferences.modality.*.in' => 'Each modality must be one of: remote, hybrid, presential, part-time, full-time.',
        ];
    }
}
