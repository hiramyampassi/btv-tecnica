<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TechFormRequest;
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

class ListasController extends Controller
{
    public function index(TechFormRequest $request)
    {
        if($request->codigo==null){
            //query para mostrar los formularios que el usuario envio y si la busqueda esta vacia ("")
            $equipos = \DB::table('formulario')->join('area','formulario.area_id','=','area.id')
            ->join('ciudad','formulario.ciudad_id','=','ciudad.id')
            ->join('region','ciudad.region_id','=','region.id')
            ->join('equipo','formulario.equipo_id','=','equipo.id')
            ->select('formulario.slug','formulario.id','codigo_form','asunto','area.nombre as area_nom','ciudad.nombre as ciudad_nom',
                'region.nombre as region_nom','formulario.fecha_inicio','usuario_id')
            ->where([['usuario_id','=',Auth::user()->id],['estado_id','=','1']])
            ->orWhere([['usuario_id','=',Auth::user()->id],['estado_id','=','2']])
            ->orderBy('id','DESC')->paginate(5);
            return view('tecnica.listas.index')->with('equipos',$equipos);
        }else{
            //query para mostrar los resultados de la barra de busquedas, solo si se puso algun valor valido (Ej: "5")
            $forms = \DB::select(
            'SELECT a.slug,a.ruta,a.id cod, a.codigo_form codigo_form, a.asunto,e.nombre as area_nom,
            f.nombre as ciudad_nom,g.nombre as region_nom,a.fecha_inicio,usuario_id
            FROM formulario AS a, equipo AS b, usuario AS d, area AS e, ciudad AS f, region AS g,(SELECT @rownum:=0) r
            WHERE a.equipo_id = b.id
            AND (a.estado_id =1 OR a.estado_id =2 OR a.estado_id =3)
            AND a.usuario_id = d.id
            AND d.area_id = e.id
            AND d.ciudad_id = f.id
            AND f.region_id = g.id
            AND a.codigo_form = '. $request->codigo .'
            ORDER BY a.id ASC');

            //Funcion para la PAGINACION MANUAL de un ARRAY
            $pageStart = \Request::get('page', 1);
            // Start displaying items from this number;
            $offSet = ($pageStart * 5) - 5; 
            // Get only the items you need using array_slice
            $itemsForCurrentPage = array_slice($forms, $offSet, 5, true);
            $equipos =  new LengthAwarePaginator($itemsForCurrentPage, count($forms), 
                5,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
            //retorna una vista para mostrar el listado de usuarios en la base de datos
            return view('tecnica.listas.index')->with('equipos',$equipos);
        }
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
            ->join('area','usuario.area_id','=','area.id')
            ->select('usuario.id','usuario.nombre as u_nom','usuario.apellido as u_ape','area.nombre as a2_nom')
            ->where([['formulario.slug','=',$id]])->get();

            $cod = Formulario::findBySlug($id)->codigo_form;
            $valor = str_pad($cod, 5, '0', STR_PAD_LEFT);
            //$equipos = Equipo::find($id);
            return view('tecnica.listas.show')->with('equipos',$equipos)
            ->with('valor',$valor)->with('usuarios',$usuarios);
        }else
            abort('503');

    }

    public function path($id)
    {
        //query para mostrar los formularios recibidos a cada area
        $forms = Formulario::findBySlug($id);
        if($forms != null){
            $rutas = \DB::select(
            'SELECT a.slug,a.ruta,a.id cod, a.codigo_form codigo_form, a.asunto, CONCAT( d.nombre,  " ", d.apellido ) enviado_por,
            e.nombre a_nom, CONCAT( f.nombre,  ", ", g.nombre ) ciudad_origen, a.fecha_inicio fecha_envio
            FROM formulario AS a, equipo AS b, usuario AS d, area AS e, ciudad AS f, region AS g,(SELECT @rownum:=0) r
            WHERE a.equipo_id = b.id
            AND (a.estado_id =1 OR a.estado_id =2 OR a.estado_id =3 OR a.estado_id =4)
            AND a.usuario_id = d.id
            AND d.area_id = e.id
            AND d.ciudad_id = f.id
            AND f.region_id = g.id
            AND a.codigo_form = '. $forms->codigo_form .'
            ORDER BY a.id ASC');

            $cod = Formulario::findBySlug($id)->codigo_form;
            //dd($rutas);
            $valor = str_pad($cod, 5, '0', STR_PAD_LEFT);

            if($rutas != null)
                return view('tecnica.listas.path')->with('rutas',$rutas)->with('valor',$valor)->with('cod',$cod);
        }else
            abort('503');
    }

    public function printAll($id)
    {
        //$val = Formulario::find($id);
        
            $rutas = \DB::select(
            'SELECT a.ruta,a.id cod, a.codigo_form codigo_form, a.asunto, CONCAT( d.nombre,  " ", d.apellido ) enviado_por,
            e.nombre a_nom, CONCAT( f.nombre,  ", ", g.nombre ) ciudad_origen, a.fecha_inicio fecha_envio
            FROM formulario AS a, equipo AS b, usuario AS d, area AS e, ciudad AS f, region AS g
            WHERE a.equipo_id = b.id
            AND (a.estado_id =1 OR a.estado_id =2 OR a.estado_id = 3)
            AND a.usuario_id = d.id
            AND d.area_id = e.id
            AND d.ciudad_id = f.id
            AND f.region_id = g.id
            AND a.codigo_form = '. $id .'
            ORDER BY a.id ASC');
        if($rutas != null){
            $c = count($rutas);
            $nums = array();
            for($i = 1 ; $i <= $c ; $i++){
                $nums[$i] = $i;//array('id' => $i);
            }
            $cols = collect($nums);

            $valor = str_pad($id, 5, '0', STR_PAD_LEFT);
            //dd($rutas);
            return \PDF::View('tecnica.listas.print_all',compact('forms','rutas','valor','nums','cols'))
            ->stream($valor.'.pdf');
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
        ->select('formulario.slug','formulario.id','usuario.nombre as u_nom','usuario.apellido as u_ape','area.nombre as a_nom',
            'ciudad.nombre as c_nom','region.nombre as r_nom','marca','componentes','equipo.descripcion as des',
            'garantia','condicion.nombre as con','observacion','codigo_btv','codigo_otro','codigo_form',
            'formulario.asunto')
        ->where([['formulario.slug','=',$id]])->get();
        //condicion para validar si se encuentra o no el formulario
        if($equipos != null){
            $usuarios = \DB::table('formulario')->join('usuario','formulario.usuario_id','=','usuario.id')
            ->join('area','usuario.area_id','=','area.id')
            ->select('usuario.id','usuario.nombre as u_nom','usuario.apellido as u_ape','area.nombre as a2_nom')
            ->where([['formulario.slug','=',$id]])->get();

            $cod = Formulario::findBySlug($id)->codigo_form;
            $valor = str_pad($cod, 5, '0', STR_PAD_LEFT);

            return \PDF::View('tecnica.listas.print_form',compact('equipos','usuarios','valor'))
            ->setPaper('letter')->stream($valor.'.pdf');
        }else
            abort('503');
    }
}
