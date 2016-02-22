<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EquipoRequest extends Request
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
            //unique:usuarios hace que solo se valide los correos, apuntando a la tabla USUARIOS de la columna correo,
            //NO el campo email de la tabla usuarios
            //'codigo_form'   =>  'required'
        ];
    }
}
