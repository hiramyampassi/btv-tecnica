@extends('main.main')

@section('title','Ruta del formulario')

@section('cabecera','RUTA DEL FORMULARIO - '.$valor)

@section('contenido')
<table class="table table-striped">

	@include('main.partials.clock')
		<thead>
			<th class="text-center">Ruta #</th>
			<th>Asunto</th>
			<th>Enviado por</th>
			<th>Area de <br>origen</th>
			<th>Lugar de <br>origen</th>
			<th>Fecha de envio<br> (AAAA/MM/DD)</th>
			<th class="text-right">
				<a href="{{ route('tecnica.listas.print_all',$valor) }}" class="btn btn-success" title="Imprimir la ruta del formulario"><span class="glyphicon glyphicon-print"></span></a>
			</th>

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
						<td class="text-center"> Sin movimiento </td>
					@endif
					<td class="text-right" width="15%">
						<a href="{{ route('tecnica.listas.show',$ruta->slug) }}" class="btn btn-default" title="Vista del formulario"><span class="glyphicon glyphicon-eye-open"></span></a>
						<a href="{{ route('tecnica.listas.print_form',$ruta->slug) }}" class="btn btn-success" title="Imprimir formulario"><span class="glyphicon glyphicon-print"></span></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
		<div class="form-group text-center">
			<a href="{{ route('tecnica.listas.index') }}" class="btn btn-danger">Volver</a>
		</div>
@endsection