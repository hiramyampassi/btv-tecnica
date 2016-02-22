<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Usuario;
use App\Models\Ciudad;
use App\Models\Area;
use App\Http\Requests\DatPerRequest;

use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class DatPerController extends Controller
{


    public function update(DatPerRequest $request,$id)
    {
    	$usuarios = Usuario::find($id);
    	$datos = Usuario::find($id);
    	//dd($datos);
    	$usuarios->fill($request->all());
    	if( empty($usuarios->password) ){
    		$usuarios->password = $datos->password;
    	}else{
    		$usuarios->password = bcrypt($request->password);
    	}

    	dd($usuarios);
    	//$usuarios->save();

    	Flash::warning('Los datos personales del usuario se han modificado de manera exitosa');
    	return redirect()->route('tecnica.listas.index');
    }

    public function show($id)
    {
    	$datos = Usuario::findBySlug($id);
    	$ciudades = Ciudad::all()->lists('fullname','id');
    	$areas = Area::orderBy('id')->lists('nombre','id');
    	//dd($datos);
    	return view('tecnica.usuario.user_datper')//->with('usuarios',$usuarios)
    	->with('ciudades',$ciudades)->with('areas',$areas)
    	->with('datos',$datos);
    }

}
