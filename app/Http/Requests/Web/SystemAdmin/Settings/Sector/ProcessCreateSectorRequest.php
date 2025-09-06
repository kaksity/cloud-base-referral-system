<?php

namespace App\Http\Requests\Web\SystemAdmin\Settings\Sector;

use Illuminate\Foundation\Http\FormRequest;

class ProcessCreateSectorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }
}
