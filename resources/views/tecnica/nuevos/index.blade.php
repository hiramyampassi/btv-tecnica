@extends('main.main')

@section('title','Lista de equipos por enviar')

@section('cabecera','LISTA DE EQUIPOS POR ENVIAR')

@section('contenido')

	<table class="table table-striped">

	@include('main.partials.clock')
		<thead>
			<th class="text-center">Codigo del<br>formulario</th>
			<th>Asunto</th>
			<th>Area de <br>destino</th>
			<th>Lugar de <br>destino</th>
			<th></th>

		</thead>
		<tbody>
			@foreach($forms as $form)
				<tr>
					<td class="text-center">{{ $form->codigo_form }}</td>
					<td width="30%">{{ $form->asunto }}</td>
					<td>{{ $form->area_nom }}</td>
					<td>{{ $form->ciudad_nom .', '.$form->region_nom}}</td>
					<td class="text-right">
						<a href="{{ route('tecnica.nuevos.send',$form->slug) }}" class="btn btn-primary" onclick="return confirm('Esta seguro de enviar el elemento? Una vez enviado ya no podra modificarlo')" title="Enviar formulario al destino">Enviar <span class="glyphicon glyphicon-send" aria-hidden="true" ></span></a> 
						<a href="{{ route('tecnica.nuevos.show',$form->slug) }}" class="btn btn-default" title="Vista del formulario"><span class="glyphicon glyphicon-eye-open"></span> <span class="glyphicon glyphicon-edit"></span></a>
						<a href="{{ route('tecnica.nuevos.print_form',$form->slug) }}" class="btn btn-success" title="Imprimir formulario completo"><span class="glyphicon glyphicon-print"></span></a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
  	<div class="col-xs-12 col-md-4">{{ $forms->render() }}</div>
  	<div class="col-xs-6 col-md-3"><br>&nbsp&nbsp&nbsp<a href="{{ route('tecnica.nuevos.create') }}" class="btn btn-info">Agregar un nuevo equipo</a></div>
	</div><br>

@endsection