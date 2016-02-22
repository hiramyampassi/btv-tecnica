<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Region;
use Laracasts\Flash\Flash;
use App\Http\Requests\RegionRequest;

class RegionController extends Controller
{
    public function index()
    {
        //paginacion de usuarios ordenados por id y solo muestra 5 resultados
        $regiones = Region::where('eliminado','=','0')->orderBy('id','DESC')->paginate(5);
        $regiones2 = Region::where('eliminado','=','1')->orderBy('id','DESC')->paginate(5);
        //retorna una vista para mostrar el listado de usuarios en la base de datos
        return view('admin.region.index')->with('regiones',$regiones)->with('regiones2',$regiones2);
    }

    public function create(){
        return view('admin.region.create');
    }

    public function store(RegionRequest $request){
        $regiones = new Region($request->all());
        //dd($regiones);
        $regiones->save();

        Flash::success('La region '. $regiones->nombre .' ha sido agregada correctamente');
        return redirect()->route('admin.region.index');
    }

    public function edit($id)
    {
        $regiones = Region::findBySlug($id);
        if($regiones != null)
            return view('admin.region.edit')->with('regiones',$regiones);
        else
            abort('503');
    }

    public function update(Request $request, $id)
    {
        //encuentra el id seleccionado
        $region = Region::find($id);

        //define los campos que se actualizaran ----- SEGUNDA FORMA
        $region->fill($request->all());
        $region->reSluggify();
        //dd($region);
        //actualiza/guarda la informacion editada
        $region->save();

        Flash::warning('La informacion de '. $region->nombre.' ha sido modificada de manera exitosa');
        return redirect()->route('admin.region.index');
    }
    //fucnion para eliminar la region
    public function destroy($id)
    {
        $region = Region::findBySlug($id);
        if($region){
            //funcion para borrar el registro
            $region->eliminado = '1';
            //dd($region);
            $region->save();
            Flash::error('La region '. $region->nombre.' fue dado de baja de manera exitosa');
            return redirect()->route('admin.region.index');
        }else
            abort('503');
    }
    //funcion para reactivar la region
    public function reactivate($id)
    {
        $region = Region::findBySlug($id);
        if($region){
            //funcion para borrar el registro
            $region->eliminado = '0';
            //dd($region);
            $region->save();
            Flash::info('La region '. $region->nombre.' fue reactivada de manera exitosa');
            return redirect()->route('admin.region.index');
        }else
            abort('503');
    }

}
