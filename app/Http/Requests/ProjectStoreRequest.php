<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'technologies' => ['nullable', 'exists:tags,id'],
        ];
    }

    public function messages()
    {
        return [
            'technologies.exists' => 'le technologie inserite non sono valide',
        ];
    }
}