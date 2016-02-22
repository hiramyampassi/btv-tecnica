<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Ciudad extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from'    => 'nombre',
        'save_to'       =>  'slug',      
    ];

    protected $table = "ciudad";

    protected $fillable = ['region_id','nombre','slug','eliminado'];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function usuario()
    {
    	return $this->hasMany('App\Models\Usuario');
    }

    public function formularios()
    {
        return $this->hasMany('App\Models\Formulario');
    }

    public function region()
    {
    	return $this->belongsTo('App\Models\Region');
    }

    //FUNCION PARA CONCATENAR CAMPOS
    public function getFullNameAttribute()
    {
        return $this->nombre .', '. $this->region->nombre;
    }

}
