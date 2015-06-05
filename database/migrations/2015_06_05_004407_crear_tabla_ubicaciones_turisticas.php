<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUbicacionesTuristicas extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ubicaciones_turisticas', function($tabla) {
      $tabla->increments('id');
      $tabla->string('nombre');
      $tabla->string('informacion');
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
    Schema::drop('ubicaciones_turisticas');
  }

}
