<?php

namespace App\Http\Requests\Web\SystemAdmin\Settings\State;

use Illuminate\Foundation\Http\FormRequest;

class ProcessUpdateStateRequest extends FormRequest
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
            'name' => ['required', 'string'],
        ];
    }
}
