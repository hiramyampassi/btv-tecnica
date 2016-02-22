<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from'    => 'username',
        'save_to'       =>  'slug',      
    ];

    protected $table = "usuario";

    protected $fillable = ['nombre','apellido','username','password','tipo','ciudad_id','area_id','slug','eliminado'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function formularios()
    {
    	return $this->hasMany('App\Models\Formulario');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Models\Ciudad');
    }

    public function scopeBuscar($query,$nombre)
    {
    	return $query->where('nombre','LIKE',"%$nombre%")//buscar un string que este dentro la columna NOMBRE
    	->orWhere('apellido','LIKE',"%$nombre%"); //buscar un string que este dentro la columna APELLIDO
    }

    public function administrador()
    {
        return $this->tipo === 'administrador';
    }

    //FUNCION PARA CONCATENAR CAMPOS
    public function getFullName2Attribute()
    {
        return $this->nombre .' '. $this->apellido;
    }

    //funcion para saber si el USUARIO es de tipo ADMINISTRADOR
    public function admin()
    {
        return $this->tipo === 'administrador';
    }
    //funcion para saber si el USUARIO es de tipo MIEMBRO
    public function miembro()
    {
        return $this->eliminado === 1;
    }

}
