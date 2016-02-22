<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\NuevosForm;

use App\Models\Equipo;
use App\Models\Usuario;
use App\Models\Ciudad;
use App\Models\Area;
use App\Models\Condicion;
use App\Models\Formulario;

use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

//require_once 'vendor/autoload.php';
use Hashids\Hashids;

class NuevosController extends Controller
{
    public function index()
    {
        $forms = \DB::table('formulario')->join('equipo','formulario.equipo_id','=','equipo.id')
        ->join('ciudad','formulario.ciudad_id','=','ciudad.id')->join('region','ciudad.region_id','=','region.id')
        ->join('area','formulario.area_id','=','area.id')
        ->select('formulario.slug','formulario.id','codigo_form','asunto','area.nombre as area_nom','ciudad.nombre as ciudad_nom','region.nombre as region_nom')
        ->where([['usuario_id','=',Auth::user()->id],['estado_id','=','4']])->orderBy('id','DESC')->paginate(7);
        //dd($otros);
        //retorna una vista para mostrar el listado de usuarios en la base de datos
        return view('tecnica.nuevos.index')->with('forms',$forms);
    }

    public function create(Request $request){

        //Redirecciona a la vista para crear un nuevo formulario
    	$cod = Formulario::get()->all();
    	$ciudades = Ciudad::all()->lists('fullname','id');
    	$areas = Area::where('eliminado','=',0)->orderBy('id')->lists('nombre','id');
    	$usulogin = Usuario::findBySlug(Auth::user()->slug);
    	$condiciones = Condicion::orderBy('id')->lists('nombre','id')->ToArray();
    	//dd($usulogin);
        if($cod == false){
            $cc = '1';
            $aaa = str_pad($cc, 5, '0', STR_PAD_LEFT);
        	return view('tecnica.nuevos.create')->with('aaa',$aaa)
        	->with('ciudades',$ciudades)->with('areas',$areas)
        	->with('usulogin',$usulogin)->with('condiciones',$condiciones);
        }else{
        	$cc = Formulario::find(1)->max('codigo_form')+1;
        	$aaa = str_pad($cc, 5, '0', STR_PAD_LEFT);
        	//dd($aaa);
        	return view('tecnica.nuevos.create')->with('aaa',$aaa)
        	->with('ciudades',$ciudades)->with('areas',$areas)
        	->with('usulogin',$usulogin)->with('condiciones',$condiciones);
        }
    }

    //funcion para guardar los datos de la plantilla create a la DB
    public function store(NuevosForm $request)
    {
        $equipos = new Equipo($request->all());
        //dd($equipos);
        $equipos->save();
        $formularios = new Formulario($request->all());
        $formularios->usuario_id = \Auth::user()->id;
        $formularios->estado_id = '4';
        $formularios->ruta = '1';

        $cod = Formulario::get()->all();
        //condicion para conocer el id si es null comienza de 1, si ya tiene almacenado comienza despues del maximo
        if($cod == false){
            $formularios->codigo_form = '1';
            
        }else{
            $formularios->codigo_form = Formulario::find(1)->max('codigo_form')+1;
        }
        $formularios->equipo_id = $equipos->id;
        $formularios->save();

        Flash::success('El formulario del equipo ha sido agregada correctamente');
        return redirect()->route('tecnica.nuevos.index');
    }

    public function send($id)
    {
    	$formularios = Formulario::findBySlug($id);
    	$formularios->estado_id = '1';
    	$formularios->fecha_inicio = new \datetime('now');
    	//dd($formularios);
    	$formularios->save();
    	
        Flash::info('El formulario '. $formularios->codigo_form .' fue enviado exitosamente');
        return redirect()->route('tecnica.nuevos.index');
    }

    public function update(NuevosForm $request, $id)
    {
        //encuentra el id seleccionado
        $formularios = Formulario::find($id);
        
        //define los campos que se actualizaran
        $formularios->fill($request->all());
        $formularios->reSluggify();
        //actualiza/guarda la informacion editada
        $equipos = Equipo::find($formularios->equipo_id);
        $equipos->fill($request->all());
        //dd($formularios);

        $formularios->save();
        $equipos->save();

    	Flash::warning('El formulario ' . $formularios->codigo_form . ' se ha modificado de manera exitosa');
    	return redirect()->route('tecnica.nuevos.index');

    }

    public function show($id) //VALIDAR EL ID PARA QUE SE ENTRE SOLO POR EL USUARIO CREADOR,
    //CUAQUIER USUARIO PUEDE ENTRAR A CUALQUIER ID Y PUEDE CAMBIARLO. 
    {
        $forms = Formulario::findBySlug($id);
        if($forms != null){
            $equipos = Equipo::find($forms->equipo_id);
            //Queries para conocer las opciones del formulario.
            //$usuarios = Usuario::all()->lists('fullname2','id')->ToArray();
            $ciudades = Ciudad::all()->lists('fullname','id');
            $areas = Area::orderBy('id')->lists('nombre','id');
            $usulogin = Usuario::findBySlug(Auth::user()->slug);
            $condiciones = Condicion::orderBy('id')->lists('nombre','id')->ToArray();

            $cod = Formulario::findBySlug($id)->codigo_form;
            $valor = str_pad($cod, 5, '0', STR_PAD_LEFT);

            return view('tecnica.nuevos.show')->with('valor',$valor)
            ->with('equipos',$equipos)->with('forms',$forms)
            ->with('ciudades',$ciudades)->with('areas',$areas)
            ->with('usulogin',$usulogin)->with('condiciones',$condiciones);
        }else
        abort('503');
    }

    public function printForm($id)
    {
        $equipos = \DB::table('formulario')->join('area','formulario.area_id','=','area.id')
        ->join('equipo','formulario.equipo_id','=','equipo.id')
        ->join('ciudad','formulario.ciudad_id','=','ciudad.id')
        ->join('region','ciudad.region_id','=','region.id')
        ->join('condicion','equipo.condicion_id','=','condicion.id')
        ->join('usuario','formulario.usuario_id','=','usuario.id')
        ->select('formulario.id','usuario.nombre as u_nom','usuario.apellido as u_ape','area.nombre as a_nom',
            'ciudad.nombre as c_nom','region.nombre as r_nom','marca','componentes','equipo.descripcion as des',
            'garantia','condicion.nombre as con','observacion','codigo_btv','codigo_otro','codigo_form',
            'formulario.asunto')
        ->where([['formulario.slug','=',$id]])->get();
        if($equipos != null){
            $usuarios = \DB::table('formulario')->join('usuario','formulario.usuario_id','=','usuario.id')
            ->join('area','usuario.area_id','=','area.id')
            ->select('usuario.id','usuario.nombre as u_nom','usuario.apellido as u_ape','area.nombre as a2_nom')
            ->where([['formulario.id','=',$id]])->get();

            $cod = Formulario::findBySlug($id)->codigo_form;
            $valor = str_pad($cod, 5, '0', STR_PAD_LEFT);

            return \PDF::View('tecnica.nuevos.print_form',compact('equipos','usuarios','valor'))
            ->setPaper('letter')->stream($valor.'.pdf');
        }else
            abort('503');
    }

}
