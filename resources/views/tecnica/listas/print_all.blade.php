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
  <h3 class="text-center">Hoja de ruta</h3>
  <p>Nro. de formulario: {!! $valor !!}</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th class="text-center">Ruta #</th>
    		<th>Asunto</th>
    		<th>Enviado por</th>
    		<th>Area de <br>origen</th>
    		<th>Lugar de <br>origen</th>
    		<th>Fecha de envio<br> (AAAA/MM/DD)</th>
      </tr>
    </thead>
    <tbody>
    @foreach($rutas as $ruta)
      <tr>
        <td width="7%" class="text-center">{{ $ruta->ruta }}</td>
        <td width="15%">{{ $ruta->asunto }}</td>
        <td width="20%">{{ $ruta->enviado_por }}</td>
        <td width="15%">{{ $ruta->a_nom }}</td>
        <td width="15%">{{ $ruta->ciudad_origen }}</td>
        @if( $ruta->fecha_envio != "0000-00-00 00:00:00")
          <td width="10%">{{ $ruta->fecha_envio }} </td>
        @else
          <td> Sin movimiento </td>
        @endif
      </tr>
    @endforeach
    </tbody>
  </table>
</div>

</body>
</html>