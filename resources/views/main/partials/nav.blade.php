<nav class="navbar navbar-default navbar-custom">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="{{ url('/home') }}">BTV-TECNICA</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <!-- El if Auth user sirve para mostrar las opciones, pero solo cuando uno esta LOGEADO!!! -->
    @if(Auth::user())
      <ul class="nav navbar-nav">
        <li><a href="{{ url('/home') }}"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
        {{-- ADMINISTRACION --}}
        @if(Auth::user()->admin())
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                Administracion<span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('admin.usuarios.index') }}"><i class="fa fa-users"></i> Usuarios</a></li>
                <li><a href="{{ route('admin.formularios.index') }}"><i class="fa fa-btn glyphicon glyphicon-list-alt"></i> Formularios</a></li>
                <li><a href="{{ route('admin.area.index') }}"><i class="fa fa-circle"></i> Areas</a></li>
                <li><a href="{{ route('admin.region.index') }}"><i class="fa fa-building-o"></i> Region</a></li>
                <li><a href="{{ route('admin.ciudad.index') }}"><i class="fa fa-btn glyphicon glyphicon-ice-lolly-tasted"></i> Ciudad</a></li>
            </ul>
        </li>
        @endif
        {{-- USUARIO MIEMBRO --}}
        
        <li><a href="{{ route('tecnica.listas.index') }}">Formularios enviados</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                Formularios por enviar<span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('tecnica.nuevos.create') }}"><i class="fa fa-btn glyphicon glyphicon-plus"></i> Crear nuevo formulario</a></li>
                <li><a href="{{ route('tecnica.nuevos.index') }}"><i class="fa fa-btn glyphicon glyphicon-list-alt"></i> Lista de formularios por enviar</a></li>
            </ul>
        </li>
        <li><a href="{{ route('tecnica.recibidos.index') }}">Formularios recibidos</a></li>
        <li><a href="#">Equipos</a></li>
      </ul>
    @endif
      <ul class="nav navbar-nav navbar-right">
        
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Entrar</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->nombre}} {{ Auth::user()->apellido}}<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('tecnica.usuario.show', Auth::user()->slug) }}"><i class="glyphicon glyphicon-user"></i> Datos personales</a></li>
                    <li><a href="#"><i class="fa fa-question"></i> &nbsp;Ayuda</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Salir</a></li>
                </ul>
            </li>
        @endif
      </ul>
    </div>
  </div>
</nav>