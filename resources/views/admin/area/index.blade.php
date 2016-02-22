@extends('main.main')

@section('title','Lista de areas')

@section('cabecera','LISTA DE AREAS')

@section('contenido')

<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#area" aria-controls="home" role="tab" data-toggle="tab">Areas disponibles</a></li>
    <li role="presentation"><a href="#baja" aria-controls="profile" role="tab" data-toggle="tab">Areas eliminadas</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="area">

	<table class="table table-striped">
		<thead>
			<th width="5%">#</th>
			<th width="70%">Nombre del area</th>
			<th></th>
		</thead>
		<tbody>
			@foreach ($estados as $estado)
				<tr>
					<td>{{ $estado->id }}</td>
					<td>{{ $estado->nombre }}</td>
					<td> 
						<a href="{{ route('admin.area.edit',$estado->slug) }}" class="btn btn-warning">Editar <span class="glyphicon glyphicon-pencil"></span></a>
						<a href="{{ route('admin.area.destroy',$estado->slug) }}" class="btn btn-danger" onclick="return confirm('Esta seguro de eliminar el elemento?')">Eliminar <span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
	  <div class="col-xs-12 col-md-4">{{ $estados->render() }}</div>
	  <div class="col-xs-6 col-md-3"><br>&nbsp&nbsp&nbsp<a href="{{ route('admin.area.create') }}" class="btn btn-info">Agregar nuevo estado</a></div>
	</div>

   </div>

	<div role="tabpanel" class="tab-pane" id="baja">
		<table class="table table-striped">
		<thead>
			<th width="5%">#</th>
			<th width="70%">Nombre del area</th>
			<th></th>
		</thead>
		<tbody>
			@foreach ($estados2 as $estado2)
				<tr>
					<td>{{ $estado2->id }}</td>
					<td>{{ $estado2->nombre }}</td>
					<td> 
						<a href="{{ route('admin.area.reactivate',$estado2->slug) }}" class="btn btn-info" onclick="return confirm('Esta seguro de reactivar la area presente?')">Reactivar <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span></a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
	  <div class="col-xs-12 col-md-4">{{ $estados2->render() }}</div>
	  <div class="col-xs-6 col-md-3"></div>
	</div>

	</div>
   </div>
</div>

@endsection