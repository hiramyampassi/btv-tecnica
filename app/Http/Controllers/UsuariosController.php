<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Usuario;
use App\Models\Area;
use App\Models\Ciudad;

use Laracasts\Flash\Flash;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioEditRequest;

class UsuariosController extends Controller
{
    public function index(Request $request)
	{
		//paginacion de usuarios ordenados por id y solo muestra 5 resultados
		$usuarios = Usuario::where('eliminado','=','0')->buscar($request->nombre)->orderBy('id','DESC')->paginate(5);

        $usuarios2 = Usuario::where('eliminado','=','1')->buscar($request->nombre)->orderBy('id','DESC')->paginate(5);

		//retorna una vista para mostrar el listado de usuarios en la base de datos
		return view('admin.usuarios.index')->with('usuarios',$usuarios)->with('usuarios2',$usuarios2);
	}

    public function create(){
        $areas = Area::orderBy('id')->lists('nombre','id')->ToArray();
        $ciudades = Ciudad::all()->lists('fullname','id')->ToArray();

        	return view('admin.usuarios.create')->with('areas',$areas)
        ->with('ciudades',$ciudades);
    }

    public function store(UsuarioRequest $request){
    	//agarra la informacion del formulacion de creacion de nuevo
    	$usuarios = new Usuario($request->all());	
    	//dd($usuarios);
    	$usuarios->password = bcrypt($request->password);
    	//guarda el array de datos mandado
    	$usuarios->save();
    	
    	//usando laracast y redireccionando a una ruta especifica
    	flash::success("Se ha registrado a " . $usuarios->nombre .' '. $usuarios->apellido ." de forma exitosa");  
    	//\Session::flash('flash_message','Creado satisfactoriamente');
    	return redirect()->route('admin.usuarios.index');
    }

    public function edit($id)
    {
        $usuario = Usuario::findBySlug($id);

        if($usuario != null){
            $ciudades = Ciudad::all()->lists('fullname','id');
            $areas = Area::orderBy('id')->lists('nombre','id');
            //dd($usuario);
            return view('admin.usuarios.edit')->with('usuario',$usuario)
            ->with('ciudades',$ciudades)->with('areas',$areas);
        }else
            abort('503');
    }

    //en en formulario de edit.blade, se incluye la ruta y el $usuario 'route' => ['admin.usuarios.update',$usuario]
    //sino no funcionara
    public function update(UsuarioEditRequest $request, $id)
    {
        //encuentra el id seleccionado
        $usuario = Usuario::find($id);
        $datos = Usuario::find($id);

        //define los campos que se actualizaran ----- SEGUNDA FORMA
        $usuario->fill($request->all());
        $usuario->reSluggify();
        if( empty($usuario->password) ){
            $usuario->password = $datos->password;
        }else{
            $usuario->password = bcrypt($request->password);
        }

        //actualiza/guarda la informacion editada
        $usuario->save();

        Flash::warning('La informacion de '. $usuario->nombre.' '.$usuario->apellido. ' ha sido modificada de manera exitosa');
        return redirect()->route('admin.usuarios.index');
    }
    //funcion para dar de baja a un usuario
    public function destroy($id)
    {
        $usuario = Usuario::findBySlug($id);
        if($usuario != null){
            //funcion para borrar el registro
            $usuario->password = \Crypt::encrypt(str_random(16));
            $usuario->eliminado = '1';
            //dd($usuario);
            $usuario->save();
            Flash::error('El usuario '. $usuario->nombre.' '.$usuario->apellido. ' fue dado de baja de manera exitosa');
            return redirect()->route('admin.usuarios.index');
        }else
            abort('503');
    }
    //funcion para reactivar la cuenta de un usuario
    public function reactivate($id)
    {
        $usuario = Usuario::findBySlug($id);
        if($usuario != null){
            $usuario->password = bcrypt(str_random(8));
            $usuario->eliminado = '0';
            $usuario->save();
            Flash::info('El usuario '. $usuario->nombre.' '.$usuario->apellido. ' fue dado de baja de manera exitosa.
                <br>Cambiar el password del usuario por uno nuevo.');
            return redirect()->route('admin.usuarios.index');
        }else
            abort('503');
    }
}
