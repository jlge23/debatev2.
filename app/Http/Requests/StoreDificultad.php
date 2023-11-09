<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDificultad extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dificultad' => 'required|max:255|regex:/(^([0-9a-zA-zÑñÁÉÍÓÚáéíóú\' ]+)$)/u',
            'puntaje' => 'required|numeric',
            'tiempo' => 'required|numeric',
            'status' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'dificultad' => 'Descripción de la dificultad',
            'puntaje' => 'Puntaje asociado a la dificultad',
            'tiempo' => 'Tiempo para responder la pregunta',
            'status' => 'Estado de la dificultad'
        ];
    }

    public function messages()
    {
        return [
            'dificultad.required' => 'Descipción de la dificultad',
            'dificultad.max' => 'Cantidad máxima de caracteres permitidos (512)',
            'dificultad.regex' => 'Sólo se permiten caracteres en Mayusculas, minusculas, números y cactacteres .\' y Espacios',
            'puntaje.required' => 'Valor del puntaje requerido',
            'puntaje.numeric' => 'El valor debe ser numerico',
            'tiempo.required' => 'Tiempo de respuesta requerido',
            'tiempo.numeric' => 'El valor debe ser numerico',
            'status.required' => 'Estado de la dificultad requerido'
        ];
    }
}
