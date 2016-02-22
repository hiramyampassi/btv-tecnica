@extends('main.main')

@section('title','Lista de regiones')

@section('cabecera','LISTA DE REGIONES')

@section('contenido')

<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#region" aria-controls="home" role="tab" data-toggle="tab">Regiones disponibles</a></li>
    <li role="presentation"><a href="#baja" aria-controls="profile" role="tab" data-toggle="tab">Regiones eliminadas</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="region">

	<table class="table table-striped">
		<thead>
			<th width="5%">#</th>
			<th width="70%">Nombre de la region</th>
			<th></th>
		</thead>
		<tbody>
			@foreach ($regiones as $region)
				<tr>
					<td>{{ $region->id }}</td>
					<td>{{ $region->nombre }}</td>
					<td> 
						<a href="{{ route('admin.region.edit',$region->slug) }}" class="btn btn-warning">Editar <span class="glyphicon glyphicon-pencil"></span></a>
						<a href="{{ route('admin.region.destroy',$region->slug) }}" class="btn btn-danger" onclick="return confirm('Esta seguro de eliminar el elemento?')">Eliminar <span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
	  <div class="col-xs-12 col-md-4">{{ $regiones->render() }}</div>
	  <div class="col-xs-6 col-md-3"><br>&nbsp&nbsp&nbsp<a href="{{ route('admin.region.create') }}" class="btn btn-info">Agregar nueva region</a></div>
	</div>
   </div>

	<div role="tabpanel" class="tab-pane" id="baja">
	<table class="table table-striped">
		<thead>
			<th width="5%">#</th>
			<th width="70%">Nombre de la region</th>
			<th></th>
		</thead>
		<tbody>
			@foreach ($regiones2 as $region2)
				<tr>
					<td>{{ $region2->id }}</td>
					<td>{{ $region2->nombre }}</td>
					<td> 
						<a href="{{ route('admin.region.reactivate',$region2->slug) }}" class="btn btn-info" onclick="return confirm('Esta seguro de reactivar la region presente?')">Reactivar <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span></a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
	  <div class="col-xs-12 col-md-4">{{ $regiones2->render() }}</div>
	  <div class="col-xs-6 col-md-3"></div>
	</div>

	</div>
   </div>
</div>

@endsection