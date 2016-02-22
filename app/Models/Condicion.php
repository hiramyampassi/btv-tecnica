<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condicion extends Model
{
    protected $table = "condicion";

    protected $fillable = ['nombre','descripcion'];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function equipo()
    {
    	return $this->hasMany('App\Models\Equipo');
    }
}
