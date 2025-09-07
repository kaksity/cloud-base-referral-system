<?php

namespace App\Http\Requests\Web\SystemAdmin\Settings\Ward;

use Illuminate\Foundation\Http\FormRequest;

class ProcessUpdateWardRequest extends FormRequest
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
            'local_government_area_id' => ['required', 'uuid', 'exists:local_government_areas,id'],
            'name' => ['required', 'string'],
        ];
    }
}
