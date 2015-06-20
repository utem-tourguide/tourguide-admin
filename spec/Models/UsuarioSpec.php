<?php namespace spec\TourGuide\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UsuarioSpec extends ObjectBehavior {

  public function it_cifra_contraseñas() {
    $this->cifrarContrasena('asdfg') ->shouldNotBe('asdfg');
    $this->cifrarContrasena('zxcv')  ->shouldNotBe('zxcv');
    $this->cifrarContrasena('qwerty')->shouldNotBe('qwerty');
  }

}
