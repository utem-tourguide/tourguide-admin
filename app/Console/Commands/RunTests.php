<?php namespace TourGuide\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class RunTests extends Command implements SelfHandling {

  protected $name = 'test';
  protected $description = 'Corre las suites de pruebas';

  /**
   * Ejecuta las diversas suites que componen las pruebas de la aplicación.
   *
   * @return void
   */
  public function handle() {
    $this->ejecutar('php vendor/bin/phpspec run --stop-on-failure -f dot');
    $this->ejecutar('php vendor/bin/phpunit --stop-on-failure');
  }

  /**
   * Ejecuta un comando y termina inmediatamente si no devuelve 0, lanzando
   * el código de error devuelto.
   *
   * @param  string $comando
   * @return null
   */
  private function ejecutar($comando) {
    $retorno = 0;
    system($comando, $retorno);
    if ($retorno != 0) exit($retorno);
  }

}
