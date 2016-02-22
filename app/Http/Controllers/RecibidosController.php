<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Equipo;
use App\Models\Usuario;
use App\Models\Ciudad;
use App\Models\Area;
use App\Models\Condicion;
use App\Models\Formulario;
use App\Models\Estado;

use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class RecibidosController extends Controller
{
    public function index()
    {
    	//funcion para mostrar los formularios enviados a las distintas areas
      
        //Informacion del usuario actual-------------
        $usulogin = Usuario::find(Auth::user()->id);
        //dd($usulogin);
        //query para mostrar los formularios recibidos a cada area
        $enviados = \DB::select(
        'SELECT a.slug,a.id cod,a.codigo_form codigo_form,a.asunto,concat(d.nombre," ",d.apellido) enviado_por,e.nombre a_nom,
        concat(f.nombre,", ",g.nombre) ciudad_origen,a.fecha_inicio fecha_envio, h.id ids,h.nombre estado
        FROM formulario AS a, equipo AS b, usuario AS c, usuario AS d,area AS e,ciudad AS f,region AS g,estado AS h
        WHERE a.equipo_id = b.id
        AND a.area_id = c.area_id
        AND a.ciudad_id = c.ciudad_id
        AND a.usuario_id = d.id
        AND d.area_id = e.id
        AND d.ciudad_id = f.id
        AND f.region_id = g.id
        AND a.estado_id = h.id
        AND (a.estado_id=1 OR a.estado_id=2)
        AND c.id = '.$usulogin->id.' ORDER BY a.id DESC');

        //Funcion para la PAGINACION MANUAL de un ARRAY
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * 5) - 5; 
        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($enviados, $offSet, 5, true);
        $enviados2 =  new LengthAwarePaginator($itemsForCurrentPage, count($enviados), 
            5,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
        //dd($enviados2);

        if($enviados2 != null){
        	//dd($enviados2);
        	return view('tecnica.recibidos.index')->with('enviados2',$enviados2);
        }else{
        	//agregar un ruta de error -----------------------------------------------------
        	//dd('no hay nada');
        	return view('tecnica.recibidos.index')->with('enviados2',$enviados2);
        }
        
    }
    public function resend($id)
    {
        //Queries para las mostrar las opciones del formulario correspondiente
    	$ciudades = Ciudad::all()->lists('fullname','id');
    	$areas = Area::orderBy('id')->lists('nombre','id');
    	$usulogin = Usuario::find(Auth::user()->id);
    	$condiciones = Condicion::orderBy('id')->lists('nombre','id')->ToArray();

        $cod = Formulario::findBySlug($id);
        //dd($usulogin);
        if($cod != null){
            //Busqueda del formulario temporal creado al marcar el mensaje recibido
            $cod = Formulario::findBySlug($id)->codigo_form;
            $valor = str_pad($cod, 5, '0', STR_PAD_LEFT);
            //------------------------------
        	$enviados2 = \DB::select(
            'SELECT MAX( a.id ) cod,a.codigo_form codigo_form
            FROM formulario AS a, equipo AS b, usuario AS c, usuario AS d
            WHERE a.equipo_id = b.id
            AND a.area_id = c.area_id
            AND a.ciudad_id = c.ciudad_id
            AND a.usuario_id = d.id
            AND a.codigo_form = '. $cod.'');
            //----------------------------------
            foreach ($enviados2 as $en) {
            	$forms = Formulario::find($en->cod);
            }
            $equipos = Equipo::find($forms->equipo_id);
            //dd($equipos);
            return view('tecnica.recibidos.resend')->with('valor',$valor)
            ->with('ciudades',$ciudades)->with('forms',$forms)
            ->with('areas',$areas)->with('usulogin',$usulogin)
            ->with('condiciones',$condiciones)->with('equipos',$equipos);
        }else
            abort('503');

    }
    public function update(Request $request,$id)
    {
        $formularios = Formulario::find($id);
        $formularios->fill($request->all());
        $formularios->estado_id = '4';
        $formularios->reSluggify();
        //dd($formularios);
        $formularios->save();

    	$equipos = Equipo::find($formularios->equipo_id);
    	$equipos->fill($request->all());
        //dd($equipos);
        $equipos->save();

        Flash::success('El formulario del equipo '. $formularios->codigo_form . ' ha sido deriva de manera exitosa<br>
        Ir la pagina de "LISTA DE FORMULARIOS POR ENVIAR" para confirmar y enviar el formulario a su destino correspondiente');
        return redirect()->route('tecnica.nuevos.index');

    }

    public function show($id)
    {
        $equipos = \DB::table('formulario')->join('area','formulario.area_id','=','area.id')
        ->join('equipo','formulario.equipo_id','=','equipo.id')
        ->join('ciudad','formulario.ciudad_id','=','ciudad.id')
        ->join('region','ciudad.region_id','=','region.id')
        ->join('condicion','equipo.condicion_id','=','condicion.id')
        ->join('usuario','formulario.usuario_id','=','usuario.id')
        ->select('formulario.slug','formulario.id','usuario.nombre as u_nom','usuario.apellido as u_ape','area.nombre as a_nom',
            'ciudad.nombre as c_nom','region.nombre as r_nom','marca','componentes','equipo.descripcion as des',
            'garantia','condicion.nombre as con','observacion','codigo_btv','codigo_otro','codigo_form',
            'formulario.asunto')
        ->where([['formulario.slug','=',$id]])->get();

        if($equipos != null){
            $usuarios = \DB::table('formulario')->join('usuario','formulario.usuario_id','=','usuario.id')
            ->join('area','usuario.area_id','=','area.id')->join('equipo','formulario.equipo_id','=','equipo.id')
            ->select('usuario.id','usuario.nombre as u_nom','usuario.apellido as u_ape','area.nombre as a2_nom')
            ->where([['formulario.slug','=',$id]])->get();

            $cod = Formulario::findBySlug($id)->codigo_form;
            $valor = str_pad($cod, 5, '0', STR_PAD_LEFT);
            //$equipos = Equipo::find($id);
            //dd($usuarios);
            return view('tecnica.recibidos.show')->with('equipos',$equipos)
            ->with('valor',$valor)->with('usuarios',$usuarios);
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
            ->where([['formulario.slug','=',$id]])->get();

            $cod = Formulario::findBySlug($id)->codigo_form;
            $valor = str_pad($cod, 5, '0', STR_PAD_LEFT);
            //dd($equipos);
            return \PDF::View('tecnica.nuevos.print_form',compact('equipos','usuarios','valor'))
            ->setPaper('letter')->stream($valor.'.pdf');
        }else
            abort('503');
    }

    public function checkForm(Request $request,$id)
    {
    	//Redirecciona a la vista para crear un nuevo formulario
    	//$formularios = Equipo::find($id);
        //---------------------
        //$formularios->codigo_form = Formulario::find(1)->max('codigo_form')+1;
    	$formularios = Formulario::findBySlug($id);
    	//$tech_forms->equipo_id = $formularios->id;
    	$formularios->estado_id = '2';
        $formularios->fecha_fin = new \datetime('now');
    	//dd($formularios);
    	$formularios->save();
        //busqueda de los equipos segun el ID y el EQUIPO_ID
        $equipos2 = Formulario::findBySlug($id);
        $equipos3 = Equipo::find($equipos2->equipo_id);
        //$equipos4 = Formulario::find($equipos2->codigo_form);
        //dd($equipos2);
//creacion de un EQUIPO temporal que sera editado automaticamente mas adelante
// Y sirve para MARCAR el NUMERO de la ruta actual del formulario
        $equipos = new Equipo();
        $equipos->marca = $equipos3->marca;
        $equipos->componentes = $equipos3->componentes;
        $equipos->descripcion = $equipos3->descripcion;
        $equipos->garantia = $equipos3->garantia;
        $equipos->condicion_id = $equipos3->condicion_id;
        $equipos->codigo_btv = $equipos3->codigo_btv;
        $equipos->codigo_otro = $equipos3->codigo_otro;
        //dd($equipos);
        $equipos->save();  	
//-----------------------------------------------------------------
      	$forms = new Formulario();
        $forms->usuario_id = \Auth::user()->id;
        $forms->area_id = $equipos2->area_id;
        $forms->ciudad_id = $equipos2->ciudad_id;
        $forms->equipo_id = $equipos->id;
        $forms->estado_id = '3';
        $forms->asunto = $equipos2->asunto;
        $forms->codigo_form = $equipos2->codigo_form;
        $forms->observacion = $equipos2->observacion;
        $forms->ruta = ($equipos2->ruta) + 1;
        //dd($forms);
        $forms->save();
//-----------------------------------------------------------------
        Flash::info('El formulario fue marcado como RECIBIDO');
        return redirect()->route('tecnica.recibidos.index');
    }

}
