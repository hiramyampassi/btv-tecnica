@extends('main.main')

@section('title','Editar region')

@section('cabecera','EDITAR REGION - '.$regiones->nombre)

@section('contenido')

		{!! Form::open(['route' => ['admin.region.update',$regiones], 'method' => 'PUT']) !!}

		<div class="form-group">
			{!! Form::label('name','Nombre de la region') !!}
			{!! Form::text('nombre',$regiones->nombre,['class'=>'form-control','placeholder'=>'Nombre de la region','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Actualizar',['class'=>'btn btn-success']) !!}
			<a href="{{ route('admin.region.index') }}" class="btn btn-danger">Cancelar</a>
		</div>

		{!! Form::close() !!}	

@endsection