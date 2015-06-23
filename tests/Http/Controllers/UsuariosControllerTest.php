<?php namespace tests\Http\Controllers;

use TestCase;
use TourGuide\Models\Usuario;

class UsuariosControllerTest extends TestCase {

  private $datos_usuario = ['nombre'     => 'Sarahí',
                           'apellido'   => 'Navarro',
                           'email'      => 'megamaniatica666@gmail.com',
                           'contrasena' => 'sarahinavarro',
                           'idioma'     => 'es',
                           'rol_id'     => ROL_ADMINISTRADOR];

  /**
   * @test
   */
  public function listar_usuarios() {
    $this->route('GET', 'usuarios.index');

    $this->assertViewHas('usuarios');
  }

  /**
   * @test
   */
  public function listar_usuarios_por_paginas() {
    $respuesta = $this->route('GET', 'usuarios.index');
    $view = $respuesta->original;

    $this->assertContains('Illuminate\Pagination\AbstractPaginator',
                          class_parents($view['usuarios']));
  }

  /**
   * @test
   */
  public function crear_nuevo_usuario() {
    $this->route('POST', 'usuarios.store', $this->datos_usuario);

    $this->assertEquals(2, Usuario::count());
  }

  /**
   * @test
   */
  public function eliminar_usuario() {
    $usuario = Usuario::create($this->datos_usuario);

    $this->route('DELETE', 'usuarios.destroy', $usuario->id);

    $this->assertEquals(1, Usuario::count());
  }

}
