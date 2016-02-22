<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DatPerRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'apellido' => 'required',
            'password' => 'sometimes|confirmed|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]){6,15}/',
            'password_confirmation' => 'sometimes|min:6'
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'La clave debe tener 6 caracteres como minimo, 1 letra Mayuscula y 1 caracter numerico',
        ];
    }
}
