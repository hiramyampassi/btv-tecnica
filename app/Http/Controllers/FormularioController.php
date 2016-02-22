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

class FormularioController extends Controller
{
	public function index()
    {
	//muestra todos los formularios disponibles
    	$equipos = \DB::table('formulario')->join('area','formulario.area_id','=','area.id')
        ->join('ciudad','formulario.ciudad_id','=','ciudad.id')
        ->join('region','ciudad.region_id','=','region.id')
        ->join('equipo','formulario.equipo_id','=','equipo.id')
        ->select('formulario.slug','formulario.id','codigo_form','asunto','area.nombre as area_nom','ciudad.nombre as ciudad_nom',
            'region.nombre as region_nom','formulario.fecha_inicio','usuario_id')
        ->where([['estado_id','=','1']])
        ->orWhere([['estado_id','=','2']])
        ->orderBy('id','DESC')->paginate(10);

        //retorna una vista para mostrar el listado de usuarios en la base de datos
        return view('admin.formularios.index')->with('equipos',$equipos);
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
            return view('admin.formularios.show')->with('equipos',$equipos)
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

            return \PDF::View('admin.formularios.print_form',compact('equipos','usuarios','valor'))
            ->setPaper('letter')->stream($valor.'.pdf');
        }else
            abort('503');
    }
}
