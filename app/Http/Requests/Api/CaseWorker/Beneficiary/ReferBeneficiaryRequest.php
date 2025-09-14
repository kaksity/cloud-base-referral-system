<?php

namespace App\Http\Requests\Api\CaseWorker\Beneficiary;

use Illuminate\Foundation\Http\FormRequest;

class ReferBeneficiaryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'beneficiary_id' => ['required', 'uuid', 'exists:beneficiaries,id'],
            'organization_id' => ['required', 'uuid', 'exists:organizations,id'],
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['required', 'string']
        ];
    }
}
