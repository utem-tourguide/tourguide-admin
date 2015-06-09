<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuarios extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('usuarios', function($tabla) {
      $tabla->increments('id');
      $tabla->string('email')->unique();
      $tabla->string('contrasena_cifrada');
      $tabla->string('nombre');
      $tabla->string('apellido');
      $tabla->char('idioma', 2); # es, en, fr, ...
      $tabla->integer('rol_id');
      $tabla->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('usuarios');
  }

}
