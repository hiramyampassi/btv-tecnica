<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Equipo;
use App\Models\Usuario;
use App\Models\Formulario;

use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class BuscarController extends Controller
{
    public function buscar_form(Requests $request)
    {
        dd('funciono!!! =D');
    }

}
