<?php

namespace App\Http\Requests\Web\SystemAdmin\Organization\Location;

use Illuminate\Foundation\Http\FormRequest;

class ProcessCreateLocationRequest extends FormRequest
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
            'country_id' => ['required', 'uuid', 'exists:countries,id'],
            'state_id' => ['required', 'uuid', 'exists:states,id'],
            'local_government_area_id' => ['required', 'uuid', 'exists:local_government_areas,id'],
            'ward_id' => ['required', 'uuid', 'exists:wards,id'],
            'name' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
