<?php

namespace App\Http\Requests\Api\CaseWorker\Profile;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFullNameRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'between:1,100'],
            'middle_name' => ['nullable', 'string', 'between:1,100'],
            'last_name' => ['required', 'string', 'between:1,100'],
        ];
    }
}
