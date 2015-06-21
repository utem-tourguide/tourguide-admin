<?php namespace TourGuide\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class RunTests extends Command implements SelfHandling {

  protected $name = 'test';
  protected $description = 'Corre las suites de pruebas.';

  /**
   * Ejecuta las diversas suites que componen las pruebas de la aplicación.
   *
   * @return void
   */
  public function handle() {
    system('phpspec run --stop-on-failure -f dot');
    system('phpunit --stop-on-failure');
    system('behat --stop-on-failure -f progress');
  }

}
