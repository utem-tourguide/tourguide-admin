<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInformacionDeUbicaciones extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('informacion_de_ubicaciones', function($tabla) {
      $tabla->increments('id');
      $tabla->char('idioma', 2); # Claves de idioma como en, es, fr, etc.
      $tabla->string('contenido');
      $tabla->integer('ubicacion_id');
      $tabla->timestamps();

      $tabla->foreign('ubicacion_id')
            ->references('id')->on('ubicaciones_turisticas')
            ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('informacion_de_ubicaciones');
  }

}
