@extends('main.main')

@section('title','Editar ciudad')

@section('cabecera','EDITAR CIUDAD - '.$ciudad->nombre)

@section('contenido')

		{!! Form::open(['route' => ['admin.ciudad.update',$ciudad], 'method' => 'PUT']) !!}

		<div class="form-group">
			{!! Form::label('name','Nombre de la ciudad') !!}
			{!! Form::text('nombre',$ciudad->nombre,['class'=>'form-control','placeholder'=>'Nombre de la ciudad','required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('region','Nombre de la region') !!}
			{!! Form::select('region_id',$regiones,$ciudad->region_id,['class'=>'form-control chosen-select','placeholder'=>'Seleccione una region','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Registrar',['class'=>'btn btn-success']) !!}
			<a href="{{ route('admin.ciudad.index') }}" class="btn btn-danger">Cancelar</a>
		</div>

		{!! Form::close() !!}	

@endsection