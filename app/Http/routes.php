<?php

Route::get ('',               ['as' => 'login',            'uses' => 'SesionesController@index']);
Route::post('sesiones',       ['as' => 'sesiones.store',   'uses' => 'SesionesController@store']);

Route::get('/android',   ['as' => 'obtener_app', 'uses' => 'DashboardController@android']);

Route::group(['middleware' => ['auth', 'only_admins']], function() {
  Route::get ('sesiones/salir', ['as' => 'sesiones.destroy', 'uses' => 'SesionesController@destroy']);

  Route::get('dashboard', ['as' => 'dashboard',   'uses' => 'DashboardController@index']);

	Route::resource('usuarios',                'UsuariosController');
	Route::resource('compras',                 'ComprasController',  ['only' => ['index', 'store']]);
	Route::resource('ubicaciones',             'UbicacionesController');
	Route::resource('ubicaciones.informacion', 'InformacionUbicacionesController');

	Route::resource('ubicaciones.postales',    'PostalesController', ['except' => ['edit', 'update']]);

	Route::group(['prefix' => 'administrar', 'as' => 'administrar.'], function() {
		Route::get('compras', [
		  'as'   => 'compras',
		  'uses' => 'AdministradorController@compras',
		]);

		Route::get('ubicaciones', [
		  'as'   => 'ubicaciones',
		  'uses' => 'AdministradorController@ubicaciones'
		]);

		Route::get('ubicaciones/{id}/informacion', [
		  'as'   => 'ubicaciones.informacion',
		  'uses' => 'AdministradorController@informacion',
		]);

		Route::get('ubicaciones/{id}/postales', [
		  'as'   => 'ubicaciones.postales',
		  'uses' => 'AdministradorController@postales',
		]);

		Route::get('ubicaciones/{id}/qrcode', [
			'as'   => 'ubicaciones.qrcode',
			'uses' => 'UbicacionesController@qrcode',
		]);

		Route::get('usuarios', [
		  'as'   => 'usuarios',
		  'uses' => 'AdministradorController@usuarios',
		]);
	});
});
