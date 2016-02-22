@extends('main.main')

@section('title','Cambiar clave de usuario')

@section('cabecera','CAMBIAR CLAVE')

@section('contenido')

<form class="form-horizontal">
	<div class="form-group">
		{!! Form::label('name',' Nombre de usuario',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::text('asunto',$datos->nombre.' '.$datos->apellido,['class'=>'form-control','placeholder'=>'Nombre (s) del usuario','readonly']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('name','Nueva clave ',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-6">
		{!! Form::password('asunto',['class'=>'form-control input-lg','placeholder'=>'Nueva clave']) !!}
		</div>
	</div>


	<div class="form-group">
		{!! Form::label('name','Confirmar clave: ',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-6">
		{!! Form::password('asunto',['class'=>'form-control input-lg','placeholder'=>'Confirmar nueva clave']) !!}
		</div>
	</div>
	<p class="label-warning">IMPORTANTE</p>
	<span id="helpBlock" class="help-block">
		Es la responsabilidad de cada usuario, de que su "Clave" sea segura.<br>
		Para evitar el uso de la cuenta de terceras personas.
	</span>
	<span id="helpBlock" class="help-block">
		La nueva Clave debe ser diferente a la actual, con un minimo de 8 caracteres.<br>
		Tomar en cuenta la dificultad de la clave.
	</span>
	<div class="row">
		<div class="col-md-4"><br><a href="{{ route('tecnica.usuario.user_datper') }}" class="btn btn-danger"> Cambiar</a></div>
  		<div class="col-md-4 text-center"><br><a href="{{ route('tecnica.usuario.user_datper') }}" class="btn btn-danger"> Volver</a></div>
  		<div class="col-md-4 text-center"></div>
	</div>
</form>


@endsection