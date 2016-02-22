@extends('main.main')

@section('title','Lista de usuarios')

@section('cabecera','LISTA DE USUARIOS')

@section('contenido')

<!-- INICIO BUSCADOR-->
    <div class="row">
		<div class="col-xs-12 col-md-5"></div>
  		<div class="col-xs-12 col-md-4"></div>
  		<div class="col-xs-6 col-md-3">
  			{!! Form::open(['route'=>'admin.usuarios.index', 'method'=>'GET','class'=>'navbar-form pull-center']) !!}
  				<div class="input-group">
  					{!! Form::text('nombre',null,['class'=>'form-control', 'placeholder'=>'Buscar usuario','aria-describedby'=>'buscar']) !!}
  					<span class="input-group-addon" id="buscar">
  						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
  					</span>
  				</div>
  			{!! Form::close() !!}

  		</div>
	</div>
    <!-- FIN BUSCADOR-->

<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#usuario" aria-controls="home" role="tab" data-toggle="tab">Usuarios activos</a></li>
    <li role="presentation"><a href="#baja" aria-controls="profile" role="tab" data-toggle="tab">Usuarios bloqueados</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="usuario">

	<table class="table table-striped">
		<thead>
			<th width="5%">#</th>
			<th width="14%">Nombre</th>
			<th width="18%">Apellido</th>
			<th width="18%">Nombre de usuario</th>
			<th width="20%">Tipo de usuario</th>
			<th></th>
		</thead>
		<tbody>
			@foreach ($usuarios as $usuario)
				<tr>
					<td>{{ $usuario->id }}</td>
					<td>{{ $usuario->nombre }}</td>
					<td>{{ $usuario->apellido }}</td>
					<td>{{ $usuario->username }}</td>
					<td>
						@if($usuario->tipo == "administrador")
							<span class="label label-success">{{ $usuario->tipo }}</span>
						@else
							<span class="label label-primary">{{ $usuario->tipo }}</span>
						@endif
					</td>
					<td> 
						<a href="{{ route('admin.usuarios.edit',$usuario->slug) }}" class="btn btn-warning">Editar <span class="glyphicon glyphicon-pencil"></span></a>
						<a href="{{ route('admin.usuarios.destroy',$usuario->slug) }}" class="btn btn-danger" onclick="return confirm('Esta seguro de eliminar el elemento?')">Eliminar <span class="glyphicon glyphicon-remove" aria-hidden="true" ></span></a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
	  <div class="col-xs-12 col-md-4">{{ $usuarios->render() }}</div>
	  <div class="col-xs-6 col-md-3"><br>&nbsp&nbsp&nbsp<a href="{{ route('admin.usuarios.create') }}" class="btn btn-info">Agregar nuevo usuario</a></div>
	</div>

	</div>

	<div role="tabpanel" class="tab-pane" id="baja">
		<table class="table table-striped">
		<thead>
			<th width="5%">#</th>
			<th width="14%">Nombre</th>
			<th width="18%">Apellido</th>
			<th width="18%">Nombre de usuario</th>
			<th width="20%">Tipo de usuario</th>
			<th></th>
		</thead>
		<tbody>
			@foreach ($usuarios2 as $usuario2)
				<tr>
					<td>{{ $usuario2->id }}</td>
					<td>{{ $usuario2->nombre }}</td>
					<td>{{ $usuario2->apellido }}</td>
					<td>{{ $usuario2->username }}</td>
					<td>
						@if($usuario2->tipo == "administrador")
							<span class="label label-success">{{ $usuario2->tipo }}</span>
						@else
							<span class="label label-primary">{{ $usuario2->tipo }}</span>
						@endif
					</td>
					<td> 
						<a href="{{ route('admin.usuarios.reactivate',$usuario2->slug) }}" class="btn btn-info" onclick="return confirm('Esta seguro de reactivar la cuenta del usuario presente?')">Reactivar <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span></a>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-xs-12 col-md-5"></div>
	  <div class="col-xs-12 col-md-4">{{ $usuarios2->render() }}</div>
	  <div class="col-xs-6 col-md-3"></div>
	</div>

	</div>
   </div>
</div>

@endsection