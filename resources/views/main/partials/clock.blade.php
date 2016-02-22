<script language="JavaScript" type="text/javascript">
    function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+' '+d+'-'+months[month]+'-'+year+'<br>'+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
     </script>
     <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">

        <!-- INICIO BUSCADOR-->
        {!! Form::open(['route'=>'tecnica.listas.index', 'method'=>'GET','class'=>'navbar-form pull-center']) !!}
            <div class="input-group">
                {!! Form::text('codigo',null,['class'=>'form-control', 'placeholder'=>'Buscar formulario mediante codigo. Ej: 1',
                'aria-describedby'=>'buscar']) !!}
                <span class="input-group-addon" id="buscar">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
            </div>
        {!! Form::close() !!}
        <!-- FIN BUSCADOR-->

        </div>
        <div class="col-md-3 text-center"><span id="date_time"></span></div>
    </div><br>
    <script type="text/javascript">window.onload = date_time('date_time');</script>

    