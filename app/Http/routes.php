<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
	Route::get('/', function () {
	    return view('welcome');
	});
});

Route::group(['middleware' => ['web']], function () {
// Add your routes here
	Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
		//rutas para los USUARIOS
		Route::resource('usuarios','UsuariosController');
		Route::get('usuarios/{id}/destroy',[
			'uses'	=> 'UsuariosController@destroy',
			'as'	=> 'admin.usuarios.destroy'	
		]);
		Route::get('usuarios/{id}/reactivate',[
			'uses'	=> 'UsuariosController@reactivate',
			'as'	=> 'admin.usuarios.reactivate'	
		]);
		//rutas para las REGIONES
		Route::resource('region','RegionController');
		Route::get('region/{id}/destroy',[
			'uses'	=> 'RegionController@destroy',
			'as'	=> 'admin.region.destroy'	
		]);
		Route::get('region/{id}/reactivate',[
			'uses'	=> 'RegionController@reactivate',
			'as'	=> 'admin.region.reactivate'	
		]);
		//rutas para las CIUDADES
		Route::resource('ciudad','CiudadController');
		Route::get('ciudad/{id}/destroy',[
			'uses'	=> 'CiudadController@destroy',
			'as'	=> 'admin.ciudad.destroy'	
		]);
		Route::get('ciudad/{id}/reactivate',[
			'uses'	=> 'CiudadController@reactivate',
			'as'	=> 'admin.ciudad.reactivate'	
		]);
		//rutas para las AREAS
		Route::resource('area','EstadoController');
		Route::get('area/{id}/destroy',[
			'uses'	=> 'EstadoController@destroy',
			'as'	=> 'admin.area.destroy'	
		]);
		Route::get('area/{id}/reactivate',[
			'uses'	=> 'EstadoController@reactivate',
			'as'	=> 'admin.area.reactivate'	
		]);
		//rutas para las FORMULARIOS
		Route::resource('formularios','FormularioController');
		//Ruta y funcion para imprimir un formulario unico
		Route::GET('formularios/{id}/print',[
			'uses'	=> 'FormularioController@printForm',
			'as'	=> 'admin.formularios.print_form'	
		]);

	});
	Route::group(['prefix'=>'tecnica','middleware'=>['auth']],function(){
		
		//rutas para los LISTAS
		Route::resource('listas','ListasController');
		Route::get('listas/{id}/destroy',[
			'uses'	=> 'ListasController@destroy',
			'as'	=> 'tecnica.listas.destroy'	
		]);
		//Ruta y funcion para imprimir un formulario unico
		Route::GET('listas/{id}/print',[
			'uses'	=> 'ListasController@printForm',
			'as'	=> 'tecnica.listas.print_form'	
		]);
		//Ruta y funcion para imprimir el detalle de la ruta de una formulario
		Route::GET('listas/{id}/print_all',[
			'uses'	=> 'ListasController@printAll',
			'as'	=> 'tecnica.listas.print_all'	
		]);
		Route::GET('listas/{id}/path',[
			'uses'	=> 'ListasController@path',
			'as'	=> 'tecnica.listas.path'	
		]);
		//------------------------------------------
		Route::GET('listas/buscar_form',[
			'uses'	=> 'BuscarController@buscar_form',
			'as'	=> 'tecnica.listas.buscar_form'	
		]);

		//rutas para los NUEVOS
		Route::resource('nuevos','NuevosController');
		Route::GET('nuevos/{id}/destroy',[
			'uses'	=> 'NuevosController@destroy',
			'as'	=> 'tecnica.nuevos.destroy'	
		]);
		//Ruta para enviar el formulario
		Route::GET('nuevos/{id}/send',[
			'uses'	=> 'NuevosController@send',
			'as'	=> 'tecnica.nuevos.send'	
		]);
		//Ruta y funcion para imprimir un formulario unico
		Route::GET('nuevos/{id}/print',[
			'uses'	=> 'NuevosController@printForm',
			'as'	=> 'tecnica.nuevos.print_form'	
		]);
		
		//rutas para los RECIBIDOS
		Route::resource('recibidos','RecibidosController');
		Route::get('recibidos/{id}/destroy',[
			'uses'	=> 'RecibidosController@destroy',
			'as'	=> 'admin.recibidos.destroy'	
		]);
		//Ruta para derivar el formulario a otra persona
		Route::GET('recibidos/{id}/resend',[
			'uses'	=> 'RecibidosController@resend',
			'as'	=> 'tecnica.recibidos.resend'	
		]);
		//Ruta y funcion para imprimir un formulario unico
		Route::GET('recibidos/{id}/print',[
			'uses'	=> 'RecibidosController@printForm',
			'as'	=> 'tecnica.recibidos.print_form'	
		]);
		Route::GET('recibidos/{id}/check',[
			'uses'	=> 'RecibidosController@checkForm',
			'as'	=> 'tecnica.recibidos.check'	
		]);

		//rutas para la informacion de USUARIOS
		//Route::resource('usuario','DatPerController');
		Route::resource('usuario','DatPerController');
		Route::GET('usuario/camb_pass',[
			'uses'	=> 'DatPerController@cambPass',
			'as'	=> 'tecnica.usuario.camb_pass'	
		]);
		Route::GET('recibidos/{id}',[
			'uses'	=> 'DatPerController@show',
			'as'	=> 'tecnica.recibidos.show'	
		]);
		
	});

	Route::get('/admin', [
		'as'	=>	'admin.admin',
		function () {
    	return view('admin.admin');
	}]);

});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
