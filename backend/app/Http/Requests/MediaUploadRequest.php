<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                // Define os mimetypes aceitos
                'mimes:jpg,jpeg,png,gif,mp4,mov,avi,mp3,wav,m4a',
                // Define um tamanho máximo (ex: 50MB)
                'max:51200' // 50 * 1024 KB
            ]
        ];
    }
}
