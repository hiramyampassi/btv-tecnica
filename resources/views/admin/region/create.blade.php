@extends('main.main')

@section('title','Crear region')

@section('cabecera','AGREGAR REGION')

@section('contenido')

		{!! Form::open(['route' => 'admin.region.store', 'method' => 'POST']) !!}

		<div class="form-group">
			{!! Form::label('name','Nombre de la region') !!}
			{!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre de la region','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Registrar',['class'=>'btn btn-success']) !!}
			<a href="{{ route('admin.region.index') }}" class="btn btn-danger">Cancelar</a>
		</div>

		{!! Form::close() !!}	

@endsection