<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'twitch' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_.]+$/',
            'twitter' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_.]+$/',
            'instagram' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9_.]+$/',
            'birthday' => 'nullable|date',
            'imagen' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'twitch.regex' => 'El nombre de usuario de Twitch no es válido',
            'twitter.regex' => 'El nombre de usuario de Twitter no es válido',
            'instagram.regex' => 'El nombre de usuario de Instagram no es válido',
            'imagen.image' => 'El archivo subido no es una imagen',
            'imagen.max' => 'La imagen no puede pesar más de 2MB',
        ];
    }
}
