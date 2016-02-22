@extends('main.main')

@section('title','Vista previa')

@section('cabecera','VISTA PREVIA DEL FORMULARIO'.' - '.$valor)

@section('contenido')

@foreach($equipos as $equipo)
		<div class="row">
		  <div class="col-md-6">
		  	<div class="form-inline">
				{!! Form::label('name','Asunto: ') !!}
				{!! Form::text('asunto',$equipo->asunto,['class'=>'form-control','placeholder'=>'Asunto del formulario','readonly']) !!}
			</div>
		  </div>
		  <div class="col-md-6 text-right">
		  	<a href="{{ route('tecnica.listas.print_form',$equipo->slug) }}" class="btn btn-success" title="Imprimir formulario completo"><span class="glyphicon glyphicon-print"></span></a>
		  </div>
		</div><br>

		<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				{!! Form::label('name','De:') !!}
				{!! Form::text('nom_usu',$equipo->u_nom.' '.$equipo->u_ape,['class'=>'form-control chosen-select','placeholder'=>'-------','readonly']) !!}
			</div>
		  </div>
		  @foreach($usuarios as $usuario)
		  <div class="col-md-3">
			<div class="form-group">
				{!! Form::label('name','Area de trabajo:') !!}
				{!! Form::text('nom_usu',$usuario->a2_nom,['class'=>'form-control chosen-select','placeholder'=>'-------','readonly']) !!}
			</div>
		  </div>
		  @endforeach
		  <div class="col-md-3">
		  	<div class="form-group">
				{!! Form::label('name','Area de trabajo destino') !!}
				{!! Form::text('area_id',$equipo->a_nom,['class'=>'form-control chosen-select','placeholder'=>'Seleccione el area de destino','readonly']) !!}
			</div>
		  </div>
		  <div class="col-md-3">
		  	<div class="form-group">
				{!! Form::label('name','Lugar de trabajo destino') !!}
				{!! Form::text('ciudad_id',$equipo->c_nom,['class'=>'form-control chosen-select','placeholder'=>'Seleccione el lugar de destino','readonly']) !!}
			</div>
		  </div>
		</div>
		
		<div class="row">
		   <div class="col-md-6">
		  	<div class="form-group">
				{!! Form::label('name','Marca del equipo') !!}
				{!! Form::text('marca',$equipo->marca,['class'=>'form-control','placeholder'=>'Ej: Dell, Acer, PHP, otro','readonly']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('name','Partes del equipo') !!}
				{!! Form::text('componentes',$equipo->componentes,['class'=>'form-control','placeholder'=>'Ej: Monitor, mouse, cable de poder, etc','readonly']) !!}
			</div>
		  </div>
		  <div class="col-md-6">
			<div class="form-group">
				{!! Form::label('name','Descripcion del equipo') !!}
				{!! Form::textarea('descripcion',$equipo->des,['class'=>'form-control','rows'=>5,'placeholder'=>'Ej: Color cafe con franjas blancas, Disco duro de 1Tb con 8 Gb de RAM, etc.','readonly']) !!}
			</div>
		  </div>
		</div>

		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
				{!! Form::label('name','Garantia') !!}<br>
				<div class="radio text-center disabled">
				  	<div class="form-group radio">
						<label>{{ Form::radio('garantia', 1,$equipo->garantia == 1,['disabled']) }} Si.</label>
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<label>{{ Form::radio('garantia', 0,$equipo->garantia == 0,['disabled']) }} No.</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('name','Condicion del equipo') !!}
				{!! Form::text('condicion_id',$equipo->con,['class'=>'form-control','placeholder'=>'Seleccione la condicion en la que se encuentra el equipo','readonly']) !!}
			</div>
		  </div>
		  <div class="col-md-6">
			<div class="form-group">
				{!! Form::label('name','Observaciones') !!}
				{!! Form::textarea('observacion',$equipo->observacion,['class'=>'form-control','rows'=>5,'placeholder'=>'Observaciones encontradas (Opcional, solo si es necesario)','readonly']) !!}
			</div>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-6">
		  	<div class="form-group">
				{!! Form::label('name','Codigo BTV') !!}
				{!! Form::text('codigo_btv',$equipo->codigo_btv,['class'=>'form-control','placeholder'=>'BTV-XXXXXXXXX','readonly']) !!}
			</div>
		  </div>
		  <div class="col-md-6">
		  	<div class="form-group">
				{!! Form::label('name','Otro codigo (Opcional)') !!}
				{!! Form::text('codigo_otro',$equipo->codigo_otro,['class'=>'form-control','placeholder'=>'Codigo del producto: XXXXXXXXX','readonly']) !!}
			</div>
		  </div>
		</div>
		<br>
		<div class="form-group text-center">
			<a href="{{ route('tecnica.listas.index') }}" class="btn btn-danger">Volver</a>
		</div>
@endforeach

@endsection