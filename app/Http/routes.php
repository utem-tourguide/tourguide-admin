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

Route::get('/dashboard', function() {
  return 'Proximamente...';
});
