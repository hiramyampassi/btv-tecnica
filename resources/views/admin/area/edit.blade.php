@extends('main.main')

@section('title','Editar estado')

@section('cabecera','EDITAR ESTADO - '.$areas->nombre)

@section('contenido')

		{!! Form::open(['route' => ['admin.area.update',$areas], 'method' => 'PUT']) !!}

		<div class="form-group">
			{!! Form::label('name','Nombre del nuevo estado') !!}
			{!! Form::text('nombre',$areas->nombre,['class'=>'form-control','placeholder'=>'Nombre del estado','required']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Actualizar',['class'=>'btn btn-success']) !!}
			<a href="{{ route('admin.area.index') }}" class="btn btn-danger">Cancelar</a>
		</div>

		{!! Form::close() !!}	

@endsection