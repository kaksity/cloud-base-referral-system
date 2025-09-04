<?php

namespace App\Http\Requests\Web\SystemAdmin\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class ProcessLoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],

            'password' => ['required', 'string']
        ];
    }
}
