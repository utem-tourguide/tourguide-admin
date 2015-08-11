<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => '/sesiones'], function() {
  Route::get('/entrar', ['as'   => 'sesiones.entrar',
                         'uses' => 'SesionesController@index']);
  Route::post('/entrar', ['as'   => 'sesiones.crear',
                          'uses' => 'SesionesController@entrar']);

  Route::get('/salir', ['as'   => 'sesiones.salir',
                        'uses' => 'SesionesController@salir']);
});

Route::get('/dashboard', ['as'   => 'dashboard',
                          'uses' => function() {
                                      return 'Proximamente...';
                                    }]);
Route::get('/obtener-app', ['as'   => 'obtener_app',
                            'uses' => function() {
                                        return 'Proximamente...';
                                      }]);

Route::resource('/usuarios', 'UsuariosController');
Route::resource('/ubicaciones', 'UbicacionesController');
Route::resource('ubicaciones.informacion', 'InformacionUbicacionesController');

Route::resource('ubicaciones.postales', 'PostalesController', ['except' => 'update']);
Route::post('ubicaciones/{ubicaciones}/postales/{postales}', [
  'as'   => 'ubicaciones.postales.update',
  'uses' => 'PostalesController@update',
]);

Route::get('/compras', ['as' => 'compras.index', 'uses' => 'ComprasController@index']);
Route::post('/compras', ['as'         => 'compras.store',
                         'uses'       => 'ComprasController@store']);

Route::group(['prefix' => '/administrar'], function() {
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
