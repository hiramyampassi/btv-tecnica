<!DOCTYPE html>
<html lang="es">
<head>
  <title>{!! $valor !!}</title>
  <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
    <script src="{{ asset('plugins/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
</head>

<body>

<div class="container">

  <h3 class="text-center">Formulario {{ $valor }}</h3>
  <br>
  @foreach($equipos as $equipo)
  <table class="table table-bordered">
    {{--<thead>
      <tr>
        <th class="text-center">Ruta #</th>
    	<th>Asunto</th>
    	<th>Enviado por</th>
    	<th>Area de <br>origen</th>
    	<th>Lugar de <br>origen</th>
    	<th>Fecha de envio</th>
      </tr>
    </thead>--}}
    <tbody>
    	<tr>
		    <td width="30%" class="text-left"><b>Asunto: </b></td>
		    <td width="70%">{!! $equipo->asunto !!}</td>
    	</tr>
    	<tr>
    		@foreach($usuarios as $usuario)
		    <td width="30%" class="text-left"><b>De: </b><br><b>Area de trabajo: </b></td>
		    <td width="70%">{!! $equipo->u_nom.' '.$equipo->u_ape !!}<br>{!! $usuario->a2_nom !!}</td>
		    @endforeach
    	</tr>
    	<tr>
		    <td width="30%" class="text-left"><b>Area de trabajo destino: </b><br><b>Lugar de trabajo destino: </b></td>
		    <td width="70%">{!! $equipo->a_nom !!}<br>{!! $equipo->c_nom !!}</td>
    	</tr>
    	<tr>
		    <td width="30%" class="text-left"><b>Marca del equipo: </b></td>
		    <td width="70%">{!! $equipo->marca !!}</td>
    	</tr>
    	<tr>
		    <td width="30%" class="text-left"><b>Partes del equipo: </b></td>
		    <td width="70%">{!! $equipo->componentes !!}</td>
    	</tr>
    	<tr>
		    <td width="30%" class="text-left"><b>Descripcion del equipo: </b></td>
		    <td width="70%">{!! $equipo->des !!}</td>
    	</tr>
    	<tr>
		    <td width="30%" class="text-left"><b>Estado de la garantia: </b></td>
		    @if($equipo->garantia == 1)
		    	<td width="70%">Si</td>
		    @else
		    	<td width="70%">No</td>
		    @endif
    	</tr>
    	<tr>
		    <td width="30%" class="text-left"><b>Condicion del equipo: </b></td>
		    <td width="70%">{!! $equipo->con !!}</td>
    	</tr>
    	<tr>
		    <td width="30%" class="text-left"><b>Observaciones: </b></td>
		    <td width="70%">{!! $equipo->observacion !!}</td>
    	</tr>
    	<tr>
		    <td width="30%" class="text-left"><b>Codigo BTV: </b></td>
		    <td width="70%">{!! $equipo->codigo_btv !!}</td>
    	</tr>
    	<tr>
		    <td width="30%" class="text-left"><b>Otro Codigo: </b></td>
		    <td width="70%">{!! $equipo->codigo_otro !!}</td>
    	</tr>
    </tbody>
  </table>

@endforeach
</div>

</body>
</html>