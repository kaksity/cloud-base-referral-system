<?php

namespace App\Http\Requests\Web\SystemAdmin\Settings\LocalGovernmentArea;

use Illuminate\Foundation\Http\FormRequest;

class ProcessUpdateLocalGovernmentAreaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'country_id' => ['required', 'uuid', 'exists:countries,id'],
            'state_id' => ['required', 'uuid', 'exists:states,id'],
            'name' => ['required', 'string'],
        ];
    }
}
