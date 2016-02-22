@extends('main.main')

@section('title','Vista previa')

@section('cabecera','VISTA PREVIA DEL FORMULARIO'.' - '.$valor)

@section('contenido')

{!! Form::open(['route' => ['tecnica.nuevos.update',$forms], 'method' => 'PUT']) !!}
		<div class="row">
		  <div class="col-md-6">
		  	<div class="form-inline">
				{!! Form::label('name','Asunto: ') !!}
				{!! Form::text('asunto',$forms->asunto,['class'=>'form-control','placeholder'=>'Asunto del formulario','required']) !!}
			</div>
		  </div>
		  <div class="col-md-6 text-right">
		  	<div class="form-inline">
				{!! Form::label('name','Codigo formulario') !!}
				{!! Form::text('codigo_form',$valor,['class'=>'form-control text-right','placeholder'=>'00000','required','disabled']) !!}
			</div>
		  </div>
		</div><br>
		<div class="row">
		  <div class="col-md-3">
			<div class="form-group">
				{!! Form::label('name','De:') !!}
				{!! Form::text('usuario_id',$usulogin->nombre.' '.$usulogin->apellido,['class'=>'form-control chosen-select','placeholder'=>'-------','required','disabled']) !!}
			</div>
		  </div>
		  <div class="col-md-3">
			<div class="form-group">
				{!! Form::label('name','Area de trabajo') !!}
				{!! Form::select('nombre',$areas,$usulogin->area_id,['class'=>'form-control','placeholder'=>'-------','required','disabled']) !!}
			</div>
		  </div>
		  <div class="col-md-3">
		  	<div class="form-group">
				{!! Form::label('name','Area de trabajo destino') !!}
				{!! Form::select('area_id',$areas,$forms->area_id,['class'=>'form-control chosen-select','placeholder'=>'Seleccione el area de destino','required']) !!}
			</div>
		  </div>
		  <div class="col-md-3">
		  	<div class="form-group">
				{!! Form::label('name','Lugar de trabajo destino') !!}
				{!! Form::select('ciudad_id',$ciudades,$forms->ciudad_id,['class'=>'form-control chosen-select','placeholder'=>'Seleccione el lugar de destino','required']) !!}
			</div>
		  </div>
		</div>
		
		<div class="row">
		   <div class="col-md-6">
		  	<div class="form-group">
				{!! Form::label('name','Marca del equipo') !!}
				{!! Form::text('marca',$equipos->marca,['class'=>'form-control','placeholder'=>'Ej: Dell, Acer, PHP, otro','required']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('name','Partes del equipo') !!}
				{!! Form::text('componentes',$equipos->componentes,['class'=>'form-control','placeholder'=>'Ej: Monitor, mouse, cable de poder, etc','required']) !!}
			</div>
		  </div>
		  <div class="col-md-6">
			<div class="form-group">
				{!! Form::label('name','Descripcion del equipo') !!}
				{!! Form::textarea('descripcion',$equipos->descripcion,['class'=>'form-control','rows'=>5,'placeholder'=>'Ej: Color cafe con franjas blancas, Disco duro de 1Tb con 8 Gb de RAM, etc.','required']) !!}
			</div>
		  </div>
		</div>

		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
				{!! Form::label('name','Garantia') !!}<br>
				<div class="radio text-center">
				  	<div class="form-group radio">
						<label>{{ Form::radio('garantia', 1,$equipos->garantia == 1) }} Si.</label>
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<label>{{ Form::radio('garantia', 0,$equipos->garantia == 0) }} No.</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('name','Condicion del equipo') !!}
				{!! Form::select('condicion_id',$condiciones,$equipos->condicion_id,['class'=>'form-control','placeholder'=>'Seleccione la condicion en la que se encuentra el equipo','required']) !!}
			</div>
		  </div>
		  <div class="col-md-6">
			<div class="form-group">
				{!! Form::label('name','Observaciones') !!}
				{!! Form::textarea('observacion',$forms->observacion,['class'=>'form-control','rows'=>5,'placeholder'=>'Observaciones encontradas (Opcional, solo si es necesario)']) !!}
			</div>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-6">
		  	<div class="form-group">
				{!! Form::label('name','Codigo BTV') !!}
				{!! Form::text('codigo_btv',$equipos->codigo_btv,['class'=>'form-control','placeholder'=>'BTV-XXXXXXXXX']) !!}
			</div>
		  </div>
		  <div class="col-md-6">
		  	<div class="form-group">
				{!! Form::label('name','Otro codigo (Opcional)') !!}
				{!! Form::text('codigo_otro',$equipos->codigo_otro,['class'=>'form-control','placeholder'=>'Codigo del producto: XXXXXXXXX']) !!}
			</div>
		  </div>
		</div>

		<div class="form-group">
			{!! Form::submit('Guardar cambios',['class'=>'btn btn-success']) !!}
			<a href="{{ route('tecnica.nuevos.index') }}" class="btn btn-danger">Volver</a>
		</div>

		{!! Form::close() !!}	
@endsection