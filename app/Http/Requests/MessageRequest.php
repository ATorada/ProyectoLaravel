<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'text' => 'required|string|max:255',
            'email' => 'required|email',
            'name' => 'required|string|max:15',
            'subject' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'text.required' => 'El texto es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser un email válido',
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre no puede tener más de 15 caracteres',
            'name.string' => 'El nombre debe ser un texto válido',
            'subject.required' => 'El asunto es obligatorio',
            'text.max' => 'El texto no puede tener más de 255 caracteres',
        ];
    }
}
