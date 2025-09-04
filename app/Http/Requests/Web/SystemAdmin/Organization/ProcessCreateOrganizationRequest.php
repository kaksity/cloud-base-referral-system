<?php

namespace App\Http\Requests\Web\SystemAdmin\Organization;

use Illuminate\Foundation\Http\FormRequest;

class ProcessCreateOrganizationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'organization.name' => ['required', 'string',],
            'organization.acronym' => ['required', 'string',],
            'organization.description' => ['required', 'string',],
            'organization.office_address' => ['required', 'string',],
            'organization.official_email' => ['required', 'string', 'email'],

            'organization_admin.first_name' => ['required', 'string'],
            'organization_admin.middle_name' => ['nullable', 'string'],
            'organization_admin.last_name' => ['required', 'string'],
            'organization_admin.mobile_number' => ['required', 'string'],
            'organization_admin.email' => ['required', 'string', 'email', 'unique:organization_admins,email'],
        ];
    }

    public function messages(): array
    {
        return [
            'organization.name.required' => 'The organization name is required.',
            'organization.acronym.required' => 'The organization acronym is required.',
            'organization.description.required' => 'The organization description/mission is required.',
            'organization.office_address.required' => 'The office address is required.',
            'organization.official_email.required' => 'The official email address is required.',
            'organization.official_email.email' => 'Please provide a valid official email address.',

            'organization_admin.first_name.required' => 'The admin first name is required.',
            'organization_admin.last_name.required' => 'The admin last name is required.',
            'organization_admin.mobile_number.required' => 'The admin phone number is required.',
            'organization_admin.email.required' => 'The admin email is required.',
            'organization_admin.email.email' => 'Please provide a valid email for the admin.',
            'organization_admin.email.unique' => 'This admin email is already in use.',
        ];
    }
}
