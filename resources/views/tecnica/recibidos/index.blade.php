@extends('main.main')

@section('title','Formularios recibidos')

@section('cabecera','FORMULARIOS RECIBIDOS')

@section('contenido')

	<table class="table table-striped">

	@include('main.partials.clock')
	@if($enviados2 != null)
		<thead>
			<th class="text-center">Codigo del<br>formulario</th>
			<th>Asunto</th>
			<th>Empleado<br>origen</th>
			<th>Area de<br>origen</th>
			<th>Lugar de<br>origen</th>
			<th>Fecha de envio<br>(AAAA/MM/DD)</th>
			<th title="Estado actual de los equipos">Estado</th>
			<th></th>

		</thead>
		<tbody>
			@foreach($enviados2 as $en)
				<tr>
					<td class="text-center" width="10%">{{ $en->codigo_form }}</td>
					<td width="15%">{{ $en->asunto }}</td>
					<td width="10%">{{ $en->enviado_por }}</td>
					<td width="10%">{{ $en->a_nom }}</td>
					<td width="10%">{{ $en->ciudad_origen }}</td>
					<td width="10%">{{ $en->fecha_envio }}</td>
					<td width="5%">
						@if($en->ids == "1")
							<span class="label label-danger">{{ $en->estado }}</span>
						@else
							<span class="label label-success">{{ $en->estado }}</span>
						@endif
					</td>
					
					<td class="text-right" width="25%">
					@if($en->ids == "1")
						<a href="{{ route('tecnica.recibidos.check',$en->slug) }}" class="btn btn-info" title="Marcar formulario como recibido"><span class="glyphicon glyphicon-ok"></span></a>
					@endif
						<a href="{{ route('tecnica.recibidos.resend',$en->slug) }}" class="btn btn-primary" title="Enviar formulario a otra persona"><span class="glyphicon glyphicon-share"></span> Derivar a</a>
						<a href="{{ route('tecnica.recibidos.show',$en->slug) }}" class="btn btn-default" title="Ver formulario"><span class="glyphicon glyphicon-eye-open"></span></a>
						<a href="{{ route('tecnica.recibidos.print_form',$en->slug) }}" class="btn btn-success" title="Imprimir formulario completo"><span class="glyphicon glyphicon-print"></span></a>
					</td>
				</tr>

			@endforeach
	@else
		<h4 class="text-center">No recibio ningun formulario</h4>
	@endif
		</tbody>
	</table>
	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
		<div class="col-xs-12 col-md-4">{{ $enviados2->render() }}</div>
  	<div class="col-xs-12 col-md-4"></div>
	</div><br>

@endsection