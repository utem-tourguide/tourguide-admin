<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPostales extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('postales', function($tabla) {
      $tabla->increments('id');
      $tabla->float('precio');
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
    Schema::drop('postales');
  }

}
