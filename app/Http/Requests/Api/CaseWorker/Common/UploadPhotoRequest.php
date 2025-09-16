<?php

namespace App\Http\Requests\Api\CaseWorker\Common;

use Illuminate\Foundation\Http\FormRequest;

class UploadPhotoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo' => ['required', 'file', 'mimes:png,jpg,jpeg'],
        ];
    }

    public function messages(): array
    {
        return [
            'photo.required' => 'Photo is required',
            'photo.file' => 'Photo must be a file',
            'photo.mimes' => 'Only png, jpg and jpeg photo types are allowed',
            'photo.size' => 'Photo must not exceed 1mb',
        ];
    }
}
