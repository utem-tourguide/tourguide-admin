<?php namespace tests\Http\Controllers;

use TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SesionesControllerTest extends TestCase {

  use WithoutMiddleware;

  /**
   * @test
   */
  public function formulario_para_iniciar_sesion() {
    $this->route('GET', 'sesiones.entrar');

    $this->assertResponseOk();
  }

  /**
   * @test
   */
  public function iniciar_sesion_correctamente() {
    $this->route('POST', 'sesiones.entrar', [
      'email'      => 'admin@tourguide.com',
      'contrasena' => 'admin',
    ]);

    $this->assertRedirectedToRoute('dashboard');
    $this->assertSessionHas('usuario_id');
  }

  /**
   * @test
   */
  public function iniciar_sesion_erroneamente() {
    $this->route('POST', 'sesiones.entrar', [
      'email'      => 'usuario@invalido.com',
      'contrasena' => 'invalida',
    ]);

    $this->assertRedirectedToRoute('sesiones.entrar');
    $this->assertFalse($this->app['session.store']->has('usuario_id'));
  }

  /**
   * @test
   */
  public function cerrar_sesion() {
    $this->route('GET', 'sesiones.salir');

    $this->assertRedirectedToRoute('sesiones.entrar');
    $this->assertFalse($this->app['session.store']->has('usuario_id'));
  }

}
