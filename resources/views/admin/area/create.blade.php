@extends('main.main')

@section('title','Crear estado')

@section('cabecera','AGREGAR ESTADO')

@section('contenido')

		{!! Form::open(['route' => 'admin.area.store', 'method' => 'POST']) !!}

		<div class="form-group">
			{!! Form::label('name','Nombre del nuevo estado') !!}
			{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre del estado','required']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Registrar',['class'=>'btn btn-success']) !!}
			<a href="{{ route('admin.area.index') }}" class="btn btn-danger">Cancelar</a>
		</div>

		{!! Form::close() !!}	

@endsection