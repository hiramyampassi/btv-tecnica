@extends('main.main')

@section('title','Busqueda')

@section('cabecera','RESULTADO ENCONTRADOS')

@section('contenido')

<table class="table table-striped">

	@include('main.partials.clock')

		<thead>
			<th class="text-center">Codigo del<br>formulario</th>
			<th>Asunto</th>
			<th>Area de <br>destino</th>
			<th>Lugar de <br>destino</th>
			<th>Fecha de creacion<br> (AAAA/MM/DD)</th>
			<th></th>

		</thead>
		<tbody>
			@foreach($equipos as $equipo)
				<tr>
					<td class="text-center" width="10%">{{ $equipo->codigo_form }}</td>
					<td width="20%">{{ $equipo->asunto }}</td>
					<td>{{ $equipo->area_nom }}</td>
					<td>{{ $equipo->ciudad_nom .', '.$equipo->region_nom}}</td>
					<td>{{ $equipo->fecha_inicio}}</td>
					<td class="text-right" width="20%">
						<a href="{{ route('tecnica.listas.path',$equipo->slug) }}" class="btn btn-primary" title="Ver ruta del formulario"><span class="glyphicon glyphicon-road"> Ruta</span></a>
						{{--<a href="{{ route('tecnica.listas.show_form',$equipo->slug) }}" class="btn btn-default" title="Vista del formulario"><span class="glyphicon glyphicon-eye-open"></span></a>--}}
						<a href="{{ route('tecnica.listas.print_form',$equipo->slug) }}" class="btn btn-success" title="Imprimir formulario completo"><span class="glyphicon glyphicon-print"></span></a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
	</div><br>

@endsection