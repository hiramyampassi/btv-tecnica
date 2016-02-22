<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Formulario extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from'    => 'asunto',
        'save_to'       =>  'slug',      
    ];

    protected $table = "formulario";

    protected $fillable = ['usuario_id','area_id','ciudad_id','equipo_id','estado_id','observacion','asunto'
    ,'codigo_form','fecha_inicio','fecha_fin','slug'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function equipo()
    {
    	return $this->belongsTo('App\Models\Equipo');
    }
    public function estado()
    {
    	return $this->belongsTo('App\Models\Estado');
    }
    public function ciudad()
    {
    	return $this->belongsTo('App\Models\Ciudad');
    }
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario');
    }
    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }
    //funcion para buscar CODIGO_FORM
    public function scopeBuscar($query,$codigo)
    {
        return $query->where('codigo_form','LIKE',"%$codigo%");//buscar un string que este dentro la columna NOMBRE
    }
}
