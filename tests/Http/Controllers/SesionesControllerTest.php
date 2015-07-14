<?php namespace tests\Http\Controllers;

use TestCase;
use TourGuide\Models\Usuario;
use TourGuide\Tests\CustomAssertions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SesionesControllerTest extends TestCase {

  use WithoutMiddleware;
  use CustomAssertions;

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
  public function intentar_iniciar_sesion_como_no_administrador() {
    Usuario::create([
      'email'              => 'no-admin@tourguide.com',
      'contrasena_cifrada' => Usuario::cifrarContrasena('no-admin'),
      'nombre'             => 'No administrador',
      'apellido'           => '',
      'idioma'             => 'es',
      'rol_id'             => 2,
    ]);

    $this->route('POST', 'sesiones.entrar', [
      'email'      => 'no-admin@tourguide.com',
      'contrasena' => 'no-admin',
    ]);

    $this->assertNotRedirectedToRoute('dashboard');
    $this->assertSessionHas('usuario_id');
  }

  /**
   * @test
   */
  public function cerrar_sesion() {
    $this->route('GET', 'sesiones.salir');

    $this->assertRedirectedToRoute('sesiones.entrar');
    $this->assertFalse($this->app['session.store']->has('usuario_id'));
  }

  /**
   * @test
   */
  public function devuelve_json_cuando_se_le_solicita() {
    $data = ['email'      => 'admin@tourguide.com',
             'contrasena' => 'admin'];
    $headers = ['HTTP_Accept' => 'application/json'];
    $response = $this->route('POST',
                             'sesiones.entrar',
                             [],
                             $data,
                             [],
                             [],
                             $headers);

    $this->assertResponseOk();
    $this->assertEquals('application/json',
                        $response->headers->get('Content-Type'));
  }

}
