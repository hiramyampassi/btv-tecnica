<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Ciudad;
use App\Models\Region;
use Laracasts\Flash\Flash;
use App\Http\Requests\CiudadRequest;

class CiudadController extends Controller
{
    public function index()
    {
        //paginacion de usuarios ordenados por id y solo muestra 5 resultados
        $ciudades = Ciudad::where('eliminado','=','0')->orderBy('id','DESC')->paginate(5);
        $ciudades2 = Ciudad::where('eliminado','=','1')->orderBy('id','DESC')->paginate(5);
        $regiones = Region::get()->all();
        //retorna una vista para mostrar el listado de usuarios en la base de datos
        return view('admin.ciudad.index')
        ->with('ciudades',$ciudades)->with('ciudades2',$ciudades2)
        ->with('regiones',$regiones);
    }

    public function create(){
    	$regiones = Region::where('eliminado','=','0')->orderBy('id','ASC')->lists('nombre','id');
        //dd($regiones);
        return view('admin.ciudad.create')
        ->with('regiones',$regiones);
    }

    public function store(CiudadRequest $request){
        $ciudades = new Ciudad($request->all());
        $ciudades->save();
        Flash::success('La ciudad '. $ciudades->nombre .' ha sido agregada correctamente');
        return redirect()->route('admin.ciudad.index');
    }

    public function edit($id)
    {
        $ciudad = Ciudad::findBySlug($id);
        if($ciudad != null){
            $regiones = Region::where('eliminado','=','0')->orderBy('id','ASC')->lists('nombre','id');
            return view('admin.ciudad.edit')->with('ciudad',$ciudad)->with('regiones',$regiones);
        }else
            abort('503');
    }

    public function update(Request $request, $id)
    {
        //encuentra el id seleccionado
        $ciudad = Ciudad::find($id);

        //define los campos que se actualizaran
        $ciudad->fill($request->all());
        $ciudad->reSluggify();
        //actualiza/guarda la informacion editada
        $ciudad->save();

        Flash::warning('La informacion de '. $ciudad->nombre.' ha sido modificada de manera exitosa');
        return redirect()->route('admin.ciudad.index');
    }
    //funcion para eliminar la ciudad
    public function destroy($id)
    {
        $ciudad = Ciudad::findBySlug($id);
        if($ciudad !=null){
            //funcion para borrar el registro
            $ciudad->eliminado = '1';
            $ciudad->save();
            Flash::error('La ciudad '. $ciudad->nombre.' fue dado de baja de manera exitosa');
            return redirect()->route('admin.ciudad.index');
        }else
            abort('503');
    }
    //funcion para reactivar la ciudad seleccionada
    public function reactivate($id)
    {
        $ciudad = Ciudad::findBySlug($id);
        if($ciudad !=null){
            //funcion para borrar el registro
            $ciudad->eliminado = '0';
            $ciudad->save();
            Flash::info('La ciudad '. $ciudad->nombre.' fue reactivada de manera exitosa');
            return redirect()->route('admin.ciudad.index');
        }else
            abort('503');
    }
}
