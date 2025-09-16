<?php

namespace App\Http\Requests\Api\CaseWorker\Beneficiary;

use Illuminate\Foundation\Http\FormRequest;

class CreateBeneficiaryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'basic_information.first_name' => ['required', 'string', 'max:255'],
            'basic_information.middle_name' => ['nullable', 'string', 'max:255'],
            'basic_information.last_name' => ['required', 'string', 'max:255'],
            'basic_information.gender' => ['required', 'string', 'in:male,female,other'],
            'basic_information.address' => ['nullable', 'string'],
            'basic_information.note' => ['nullable', 'string'],
            'basic_information.age_group' => ['required', 'string'],
            'basic_information.other_attributes' => ['nullable'],
            'basic_information.profile_photo_url' => ['nullable', 'url', 'max:2048'],
            'referral.organization_id' => ['nullable', 'uuid'],
            'referral.services' => ['nullable', 'array', 'min:1'],
            'referral.services.*' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name is required.',
            'last_name.required' => 'The last name is required.',
            'gender.in' => 'Gender must be male, female, or other.',
            'other_attributes.json' => 'The other attributes field must be a valid JSON object.',
            'profile_photo_url.url' => 'The profile photo must be a valid URL.',
        ];
    }
}
