<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipo extends FormRequest
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
            'nombre' => 'required|regex:/(^([0-9a-zA-zÑñÁÉÍÓÚáéíóú.\' ]+)$)/u',
            'opciones' => 'required|numeric',
            'status' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'Descripción del Tipo de pregunta',
            'opciones' => 'Numero de opciones para respuesta',
            'status' => 'Estado del Tipo de pregunta'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Descripción del Tipo de pregunta Requerido',
            'nombre.regex' => 'Sólo se permiten caracteres en Mayusculas, minusculas, números y cactacteres .\' y Espacios',
            'opciones.required' => 'Opciones para respuestasdebe ser numerico',
            'status.required' => 'Estado del Tipo de pregunta Requerido'
        ];
    }
}
