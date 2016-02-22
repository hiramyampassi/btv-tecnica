<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Area;
use Laracasts\Flash\Flash;
use App\Http\Requests\EstadoRequest;

class EstadoController extends Controller
{
    public function index()
    {
        //paginacion de usuarios ordenados por id y solo muestra 5 resultados
        $estados = Area::where('eliminado','=',0)->orderBy('id','DESC')->paginate(5);

        $estados2 = Area::where('eliminado','=',1)->orderBy('id','DESC')->paginate(5);
        //retorna una vista para mostrar el listado de usuarios en la base de datos
        return view('admin.area.index')
        ->with('estados',$estados)->with('estados2',$estados2);
    }

    public function create(){
        //Redirecciona a la vista del estado
        return view('admin.area.create');
    }
    //funcion para guardar los datos de la plantilla create a la DB
    public function store(EstadoRequest $request){
        $estados = new Area($request->all());
        $estados->save();
        Flash::success('El estado '. $estados->nombre .' ha sido agregada correctamente');
        return redirect()->route('admin.area.index');
    }

    public function edit($id)
    {
        $areas = Area::findBySlug($id);
        if($areas != null)
            return view('admin.area.edit')->with('areas',$areas);
        else
            abort('503');
    }

    public function update(Request $request, $id)
    {
        //encuentra el id seleccionado
        $area = Area::find($id);

        //define los campos que se actualizaran ----- SEGUNDA FORMA
        $area->fill($request->all());
        $area->reSluggify();
        //actualiza/guarda la informacion editada
        $area->save();

        Flash::warning('La informacion de '. $area->nombre.' ha sido modificada de manera exitosa');
        return redirect()->route('admin.area.index');
    }
    //funcion para eliminar el area de la lista
    public function destroy($id)
    {
        $area = Area::findBySlug($id);
        if($area != null){
            //funcion para borrar el registro
            $area->eliminado = '1';
            $area->save();
            Flash::error('El '. $area->nombre.' fue dado de baja de manera exitosa');
            return redirect()->route('admin.area.index');
        }else
            abort('503');
    }
    //funcion para reactivar al area
    public function reactivate($id)
    {
        $area = Area::findBySlug($id);
        if($area != null){
            //funcion para borrar el registro
            $area->eliminado = '0';
            $area->save();
            Flash::info('El '. $area->nombre.' fue reactivada de manera exitosa');
            return redirect()->route('admin.area.index');
        }else
            abort('503');
    }
}
