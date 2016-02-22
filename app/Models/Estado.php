<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = "estado";

    protected $fillable = ['nombre','descripcion'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function formularios()
    {
    	return $this->hasMany('App\Models\Formulario');
    }

}
