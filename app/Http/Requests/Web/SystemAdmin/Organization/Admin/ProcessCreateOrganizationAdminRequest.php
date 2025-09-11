<?php

namespace App\Http\Requests\Web\SystemAdmin\Organization\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProcessCreateOrganizationAdminRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'organization_id' => ['required', 'uuid', 'exists:organizations,id'],
            'first_name' => ['required', 'string'],
            'middle_name' => ['nullable', 'string'],
            'last_name' => ['required', 'string'],
            'mobile_number' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:organization_admins,email'],
        ];
    }

    public function messages(): array
    {
        return [
            'organization_id.required' => 'The organization is required.',
            'organization_id.exists' => 'The organization does not exists.',
            'first_name.required' => 'The admin first name is required.',
            'last_name.required' => 'The admin last name is required.',
            'mobile_number.required' => 'The admin phone number is required.',
            'email.required' => 'The admin email is required.',
            'email.email' => 'Please provide a valid email for the admin.',
            'email.unique' => 'This admin email is already in use.',
        ];
    }
}
