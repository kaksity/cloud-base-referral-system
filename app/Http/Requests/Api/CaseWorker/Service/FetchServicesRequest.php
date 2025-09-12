<?php

namespace App\Http\Requests\Api\CaseWorker\Service;

use Illuminate\Foundation\Http\FormRequest;

class FetchServicesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sector_id' => ['nullable', 'uuid'],
            'organization_id' => ['nullable', 'uuid']
        ];
    }
}
