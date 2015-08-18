<?php namespace TourGuide\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Este comando genera la base de datos básica, la cual es copiada por las suites de pruebas según
 * lo requieren.
 *
 * @package TourGuide\Commands
 */
class GenerarBDBase extends Command implements SelfHandling {

  protected $name = 'test:db';
  protected $description = 'Construye la básica de datos base a partir de las migraciones';

  /**
   * Ejecuta el comando.
   *
   * @return void
   */
  public function handle() {
    $bd = base_path('.db_base.sqlite');
    if (file_exists($bd)) {
      unlink($bd);
    }

    touch($bd);

    $parametros = ['--database' => 'sqlite_base'];
    $this->call('migrate', $parametros);
    $this->call('db:seed', $parametros);

    $this->info('Base de datos basica generada');
  }

}
