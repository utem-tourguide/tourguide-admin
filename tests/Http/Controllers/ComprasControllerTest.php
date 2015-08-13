<?php namespace tests\Http\Controllers;

use TestCase;
use TourGuide\Models\Compra;
use TourGuide\Controllers\ComprasController;

class ComprasControllerTest extends TestCase {

  /**
   * @test
   */
  public function crea_compras() {
    $respuesta =$this->route('POST', 'compras.store', ['usuario_id' => 1,
                                                       'postal_id'  => 1]);

    $this->assertEquals(1, Compra::count(),
      'Debería haber 1 compra guardada, pero no la hay.');
    $this->assertEquals(201, $respuesta->status(),
      'El status de la respuesta debería ser 201.');
  }

  /**
   * @test
   */
  public function se_niega_a_crear_compras_sin_usuario_id() {
    $respuesta =$this->route('POST', 'compras.store', ['postal_id' => 1]);

    $this->assertEquals(0, Compra::count(),
      'Una compra no debería guardarse sin usuario_id.');
  }

  /**
   * @test
   */
  public function se_niega_a_crear_compras_sin_postal_id() {
    $respuesta =$this->route('POST', 'compras.store', ['usuario_id' => 1]);

    $this->assertEquals(0, Compra::count(),
      'Una compra no debería guardarse sin postal_id.');
  }

}
