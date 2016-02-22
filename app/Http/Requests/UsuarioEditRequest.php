<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioEditRequest extends Request
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
            'username' => 'required',
            'password' => 'sometimes|confirmed|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]){6,15}/',
            'password_confirmation' => 'sometimes|min:6',
            'ciudad_id' => 'required',
            'area_id'   => 'required',
            'tipo'  => 'required'

        ];
    }

    public function messages()
    {
        return [
            'password.regex'        => 'La clave debe tener 6 caracteres como minimo, 1 letra Mayuscula y 1 caracter numerico.',
            'ciudad_id.required'    => 'Seleccione un elemento de la lista de Ciudades.',
            'area_id.required'      => 'Seleccione un elemento de la lista de Areas.',
            'username.unique'      => 'El nombre de usuario ya está en uso.',
        ];
    }
}
