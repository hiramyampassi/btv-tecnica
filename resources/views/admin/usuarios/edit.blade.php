@extends('main.main')

@section('title','Editar usuario')

@section('cabecera','EDITAR USUARIO')

@section('contenido')

		{!! Form::open(['route' => ['admin.usuarios.update',$usuario], 'method' => 'PUT']) !!}
		<!--{{ Form::model($usuario, array('route' => array('admin.usuarios.update', $usuario->id), 'method' => 'PUT')) }}-->
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('name','Nombre') !!}
					{!! Form::text('nombre',$usuario->nombre,['class'=>'form-control','placeholder'=>'Nombre (s)','required']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('last','Apellido') !!}
					{!! Form::text('apellido',$usuario->apellido,['class'=>'form-control','placeholder'=>'Apellidos','required']) !!}
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('username','Nombre de usuario') !!}
			{!! Form::text('username',$usuario->username,['class'=>'form-control','placeholder'=>'Ej: pp.lopez','required']) !!}
		
		<span id="helpBlock" class="help-block">Usar la inicial de los 2 nombre y el apellido paterno completo. Separar la inicial de los nombres y el apellido con un punto (.)</span>
		</div>
		<div class="form-group">
			{!! Form::label('area','Area de trabajo') !!}
			{!! Form::select('ciudad_id',$ciudades,$usuario->ciudad_id,['class'=>'form-control','placeholder'=>'Seleccione una ciudad','required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('ciudad','Area de trabajo') !!}
			{!! Form::select('area_id',$areas,$usuario->area_id,['class'=>'form-control','placeholder'=>'Seleccione una ciudad','required']) !!}
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('pass','Password (Opcional)') !!}
					{!! Form::password('password',['class'=>'form-control','placeholder'=>'*******']) !!}
					<span id="helpBlock" class="help-block">La clave debe tener 6 caracteres como minimo, 1 letra Mayuscula y 1 caracter numerico. Cambiar solo de ser NECESARIO.</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('pass','Confirmar password') !!}
					{!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'*******']) !!}
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tipo','Tipo') !!}
			{!! Form::select('tipo',['' =>'Seleccione una cuenta','miembro'=>'Miembro tecnico','administrador'=>'Administrador'],null,['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
			<a href="{{ route('admin.usuarios.index') }}" class="btn btn-danger">Cancelar</a>
		</div>
		
		{!! Form::close() !!}	

@endsection