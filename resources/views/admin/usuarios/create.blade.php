@extends('main.main')

@section('title','Crear usuario')

@section('cabecera','AGREGAR USUARIO')

@section('contenido')

		{!! Form::open(['route' => 'admin.usuarios.store', 'method' => 'POST']) !!}

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('name','Nombre') !!}
					{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre (s)','required']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('last','Apellido') !!}
					{!! Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Apellidos','required']) !!}
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('username','Nombre de usuario') !!}
			{!! Form::text('username',null,['class'=>'form-control','placeholder'=>'Ej: pp.lopez','required']) !!}
		
		<span id="helpBlock" class="help-block">Usar la inicial de los 2 nombre y el apellido paterno completo. Separar la inicial de los nombres y el apellido con un punto (.)</span>
		</div>
		<div class="form-group">
			{!! Form::label('nombre','Lugar de trabajo') !!}
			{!! Form::select('ciudad_id',$ciudades,null,['class'=>'form-control','placeholder'=>'Seleccione el lugar del trabajo','required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('tipousu','Area de trabajo') !!}
			{!! Form::select('area_id',$areas,null,['class'=>'form-control','placeholder'=>'Seleccione la area de trabajo','required']) !!}
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('pass','Password') !!}
					{!! Form::password('password',['class'=>'form-control','placeholder'=>'*******','required']) !!}
					<span id="helpBlock" class="help-block">La clave debe tener 6 caracteres como minimo, 1 letra Mayuscula y 1 caracter numerico.</span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label('pass','Confirmar password') !!}
					{!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'*******','required']) !!}
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tipousu','Tipo') !!}
			{!! Form::select('tipo',['' =>'Seleccione una cuenta','miembro'=>'Miembro tecnico','administrador'=>'Administrador'],null,['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
			<a href="{{ route('admin.usuarios.index') }}" class="btn btn-danger">Cancelar</a>
		</div>

		{!! Form::close() !!}	

@endsection