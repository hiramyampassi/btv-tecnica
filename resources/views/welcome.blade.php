@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>BIENVENIDOS AL SISTEMA DE SEGUIMIENTO PARA TECNICA</b></div>

                <div class="panel-body">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-justify">
                        <p>El sistema ayudara al usuario a administrar de mejor manera los distintos dispositivos que
                        son enviados por las distintas oficinas que se encuentran en Bolivia</p>

                        <p>En caso de no poseer una cuenta de la institucion, contactarse con el Area de sistemas para
                        la creacion de la cuenta correspondiente</p>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-12 text-center">
                        @if (Auth::guest())
                            <a class="btn btn-primary" href="{{ url('/login') }}" role="button">Entrar</a>
                        @else
                            <a class="btn btn-primary" href="{{ url('/home') }}" role="button">Ver opciones</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection