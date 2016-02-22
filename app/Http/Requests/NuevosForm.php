<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NuevosForm extends Request
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
            //'asunto' => 'min:4|max:|required|unique:nombre_tabl'
            'asunto'        => 'min:4|max:100|required',
            'area_id'       => 'required',
            'ciudad_id'     => 'required',
            'marca'         => 'min:2|max:50|required',
            'componentes'   => 'min:2|max:255|required',
            'descripcion'   => 'min:2|max:255|required',
            'garantia'      => 'required|boolean',
            'condicion_id'  => 'required',
            'observacion'   => 'max:255',
            'codigo_btv'    => 'max:100',
            'codigo_otro'   => 'max:100'
        ];
    }
}
