<?php namespace spec\TourGuide\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UsuarioSpec extends ObjectBehavior {

  public function it_cifra_contraseñas() {
    $this->cifrarContrasena('asdfg') ->shouldNotBe('asdfg');
    $this->cifrarContrasena('zxcv')  ->shouldNotBe('zxcv');
    $this->cifrarContrasena('qwerty')->shouldNotBe('qwerty');
  }

  public function it_verifica_la_contrasena_de_un_usuario() {
    $this->contrasena_cifrada = $this->cifrarContrasena('asdfg')
                                     ->getWrappedObject();

    $this->verificarContrasena('asdfg')->shouldBe(true);
    $this->verificarContrasena('zxcvb')->shouldBe(false);
  }

}
