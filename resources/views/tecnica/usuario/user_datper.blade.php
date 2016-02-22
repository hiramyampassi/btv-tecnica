@extends('main.main')

@section('title','Datos personales')

@section('cabecera','DATOS PERSONALES')

@section('contenido')

	<div class="row">
		<div class="col-md-6">
			<div class="form-inline">
				{!! Form::label('name','Nombre de usuario: ') !!}
				{!! Form::text('username',$datos->username,['class'=>'form-control','placeholder'=>'Nombre (s) del usuario','readonly']) !!}
			</div>
		</div>
	</div><br>
{!! Form::open(['route' => ['tecnica.usuario.update',$datos], 'method' => 'PUT']) !!}
<div class="row">
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('name','Nombre (s): ') !!}
		{!! Form::text('nombre',$datos->nombre,['class'=>'form-control','placeholder'=>'Nombre (s) del usuario']) !!}
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('name','Apellidos: ') !!}
		{!! Form::text('apellido',$datos->apellido,['class'=>'form-control','placeholder'=>'Apellidos del usuario']) !!}
	</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('name','Ciudad de trabajo: ') !!}
		{!! Form::select('ciudad',$ciudades,$datos->ciudad_id,['class'=>'form-control','placeholder'=>'Ciudad de trabajo','readonly']) !!}
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('name','Area de trabajo: ') !!}
		{!! Form::select('area',$areas,$datos->area_id,['class'=>'form-control','placeholder'=>'Area de trabajo','readonly']) !!}
	</div>
</div>

<div class="row">
	<div class="col-md-12 text-center">
	<br>
		<label>CAMBIAR CLAVE DE USUARIO (Opcional)</label>
	</div>
</div>

<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('name','Nueva clave: ') !!}
		{!! Form::password('password',['class'=>'form-control input-lg','placeholder'=>'Nueva clave']) !!}
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('name','Confirmar clave: ') !!}
		{!! Form::password('password_confirmation',['class'=>'form-control input-lg','placeholder'=>'Confirmar nueva clave']) !!}
	</div>
</div>
<div class="row">
	<div class="col-md-3 text-center"></div>
	<div class="col-md-6">
		<p class="label-warning text-center">IMPORTANTE</p>
		<span id="helpBlock" class="help-block text-justify">
			Es la responsabilidad de cada usuario, de que su "Clave" sea segura,
			para evitar el uso de la cuenta de terceras personas.
		</span>
		<span id="helpBlock" class="help-block text-justify">
			La nueva Clave debe ser diferente a la actual, con un minimo de 6 caracteres.
			Tomar en cuenta la dificultad de la clave, haciendo uso de letras mayusculas y caracteres numericos.
		</span>
	</div>
</div>
<div class="col-md-3"><br>
	{!! Form::submit('Guardar cambios',['class'=>'btn btn-success']) !!}
</div>
 <div class="col-md-6 text-center"><br>
 	<a href="{{ url('/home') }}" class="btn btn-danger">Cancelar</a>
 </div>

{!! Form::close() !!}


@endsection