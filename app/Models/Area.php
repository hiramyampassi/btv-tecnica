<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Area extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from'    => 'nombre',
        'save_to'       =>  'slug',      
    ];

    protected $table = "area";

    protected $fillable = ['nombre','slug'];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function usuarios()
    {
    	return $this->hasMany('App\Models\Usuario');
    }
    public function formularios()
    {
    	return $this->hasMany('App\Models\Formulario');
    }
}
