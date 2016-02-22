@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">¿Has olvidado tu contraseña?</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <span class="text-center">En caso de no tener contraseña, contactarse con el area de sistemas para
                    que se le proporcione una nueva.</span>

                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <a class="btn btn-danger" href="{{ url('/login') }}" role="button">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
