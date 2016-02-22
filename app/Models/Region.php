<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Region extends Model implements SluggableInterface
{
	use SluggableTrait;

    protected $sluggable = [
        'build_from'    => 'nombre',
        'save_to'       =>  'slug',      
    ];

    protected $table = "region";

    protected $fillable = ['nombre','slug','eliminado'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ciudades()
    {
    	return $this->hasMany('App\Models\Ciudad');
    }

}
