<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'date' => 'nullable|date',
            'hour' => 'nullable|date_format:H:i',
            'tags' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'visibility' => 'required|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'description.required' => 'La descripción es obligatoria',
            'date.date' => 'La fecha debe ser una fecha válida',
            'hour.date_format' => 'La hora debe ser una hora válida',
            'tags.string' => 'Las etiquetas deben ser un texto válido',
            'location.string' => 'La ubicación debe ser un texto válido',
            'visibility.required' => 'La visibilidad es obligatoria',
        ];
    }
}
