<?php namespace tests\TourGuide\Support;

class DatabaseTestCase extends LaravelTestCase {

  public function setUp() {
    parent::setUp();

    $this->preparar_bd();
  }

  public function tearDown() {
    parent::tearDown();

    $this->eliminar_bd();
  }

  /**
   * Prepara la base de datos para pruebas.
   */
  protected function preparar_bd() {
    copy(base_path('.db_base.sqlite'), base_path('testing.sqlite'));
  }

  /**
   * Elimina la base de datos para pruebas.
   */
  protected function eliminar_bd() {
    unlink(base_path('testing.sqlite'));
  }

}
