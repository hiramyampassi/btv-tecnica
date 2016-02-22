<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = "equipo";

    protected $fillable = ['marca','componentes','descripcion','garantia','condicion_id','codigo_btv','codigo_otro'];

    public function condicion()
    {
        return $this->belongsTo('App\Models\Condicion');
    }

    public function formularios()
    {
    	return $this->hasMany('App\Models\Formulario');
    }
}
