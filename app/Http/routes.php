<?php

Route::get('/', ['as' => 'login', 'uses' => 'SesionesController@index']);
Route::resource('sesiones', 'SesionesController', ['only' => 'store']);
Route::get('sesiones', ['as' => 'sesiones.destroy', 'uses' => 'SesionesController@destroy']);

Route::get('/dashboard', ['as' => 'dashboard',   'uses' => 'DashboardController@index']);
Route::get('/android',   ['as' => 'obtener_app', 'uses' => 'DashboardController@android']);

Route::resource('usuarios', 'UsuariosController');
Route::resource('compras', 'ComprasController', ['only' => ['index', 'store']]);
Route::resource('ubicaciones', 'UbicacionesController');
Route::resource('ubicaciones.informacion', 'InformacionUbicacionesController');

Route::resource('ubicaciones.postales', 'PostalesController', ['except' => 'update']);
Route::post('ubicaciones/{ubicaciones}/postales/{postales}', [
  'as'   => 'ubicaciones.postales.update',
  'uses' => 'PostalesController@update',
]);

Route::group(['prefix' => '/administrar'], function() {
  Route::get('/compras', [
    'as'   => 'administrar.compras',
    'uses' => 'AdministradorController@compras',
  ]);

  Route::get('/ubicaciones', [
    'as'   => 'administrar.ubicaciones',
    'uses' => 'AdministradorController@ubicaciones'
  ]);

  Route::get('/ubicaciones/{id}/informacion', [
    'as'   => 'administrar.ubicaciones.informacion',
    'uses' => 'AdministradorController@informacion',
  ]);

  Route::get('/ubicaciones/{id}/postales', [
    'as'   => 'administrar.ubicaciones.postales',
    'uses' => 'AdministradorController@postales',
  ]);

  Route::get('/usuarios', [
    'as'   => 'administrar.usuarios',
    'uses' => 'AdministradorController@usuarios'
  ]);
});
