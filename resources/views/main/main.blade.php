<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Sistema de seguimiento para Tecnica | @yield('title','Default')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/css.css') }}">

</head>

<body>

	@include('main.partials.nav')

<div class="container">
    <div class="row row-centered">
        <div class="col-sm-10">
            <div class="panel panel-success" style="width:120%">
        <!-- Default panel contents -->
            <div class="panel-heading text-center">@yield('cabecera','Bolivia TV')</div>
            <div class="panel-body">

   	<section class="section-admin">
   		@include('flash::message')
   		@include('main.partials.errors')

   		@yield('contenido')	
	</section>

			</div>
            </div>
        </div>
    </div>
</div>
	<footer class="admin-footer">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="collapse navbar-collapse">
					<p class="navbar-text navbar-right">Bolivia TV</p>
					<p class="navbar-text navbar-right">&copy {{ date('Y') }}</p>
				</div>
			</div>
		</nav>
	</footer>

	<script src="{{ asset('plugins/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>

@yield('js')	

</body>
</html>