<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCompras extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('compras', function($tabla) {
      $tabla->increments('id');
      $tabla->integer('usuario_id');
      $tabla->integer('postal_id');
      $tabla->timestamps();

      $tabla->foreign('usuario_id')
            ->references('id')->on('usuarios')
            ->onDelete('cascade');

      $tabla->foreign('postal_id')
            ->references('id')->on('postales')
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
    Schema::drop('compras');
  }

}
