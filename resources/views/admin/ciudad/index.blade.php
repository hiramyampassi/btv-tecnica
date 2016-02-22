@extends('main.main')

@section('title','Lista de ciudades')

@section('cabecera','LISTA DE CIUDADES')

@section('contenido')

<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#ciudad" aria-controls="home" role="tab" data-toggle="tab">Areas disponibles</a></li>
    <li role="presentation"><a href="#baja" aria-controls="profile" role="tab" data-toggle="tab">Areas eliminadas</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="ciudad">

	<table class="table table-striped">
		<thead>
			<th width="5%">#</th>
			<th width="35%">Nombre de la ciudad</th>
			<th width="35%">Nombre de la region</th>
			<th></th>
		</thead>
		<tbody>
			@foreach ($ciudades as $ciudad)
				<tr>
					<td>{{ $ciudad->id }}</td>
					<td>{{ $ciudad->nombre }}</td>
					@foreach($regiones as $region)
						@if($ciudad->region_id == $region->id)
							<td>{{ $region->nombre }}</td>
						@endif
					@endforeach
					<td> 
						<a href="{{ route('admin.ciudad.edit',$ciudad->slug) }}" class="btn btn-warning">Editar <span class="glyphicon glyphicon-pencil"></span></a>
						<a href="{{ route('admin.ciudad.destroy',$ciudad->slug) }}" class="btn btn-danger" onclick="return confirm('Esta seguro de eliminar el elemento?')">Eliminar <span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
	  <div class="col-xs-12 col-md-4">{{ $ciudades->render() }}</div>
	  <div class="col-xs-6 col-md-3"><br>&nbsp&nbsp&nbsp<a href="{{ route('admin.ciudad.create') }}" class="btn btn-info">Agregar nuevo usuario</a></div>
	</div>

   </div>
	<div role="tabpanel" class="tab-pane" id="baja">

	<table class="table table-striped">
		<thead>
			<th width="5%">#</th>
			<th width="35%">Nombre de la ciudad</th>
			<th width="35%">Nombre de la region</th>
			<th></th>
		</thead>
		<tbody>
			@foreach ($ciudades2 as $ciudad2)
				<tr>
					<td>{{ $ciudad2->id }}</td>
					<td>{{ $ciudad2->nombre }}</td>
					@foreach($regiones as $region)
						@if($ciudad2->region_id == $region->id)
							<td>{{ $region->nombre }}</td>
						@endif
					@endforeach
					<td> 
						<a href="{{ route('admin.ciudad.reactivate',$ciudad2->slug) }}" class="btn btn-info" onclick="return confirm('Esta seguro de reactivar la ciudad presente?')">Reactivar <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span></a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
	  <div class="col-xs-12 col-md-4">{{ $ciudades2->render() }}</div>
	  <div class="col-xs-6 col-md-3"></div>
	</div>

	</div>
   </div>
</div>

@endsection