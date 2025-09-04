<?php

namespace App\Http\Requests\Web\SystemAdmin\Organization\About;

use Illuminate\Foundation\Http\FormRequest;

class ProcessUpdateOrganizationBasicInformationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string',],
            'acronym' => ['required', 'string',],
            'description' => ['required', 'string',],
            'office_address' => ['required', 'string',],
            'official_email' => ['required', 'string', 'email'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The organization name is required.',
            'acronym.required' => 'The organization acronym is required.',
            'description.required' => 'The organization description/mission is required.',
            'office_address.required' => 'The office address is required.',
            'official_email.required' => 'The official email address is required.',
            'official_email.email' => 'Please provide a valid official email address.',
        ];
    }
}
