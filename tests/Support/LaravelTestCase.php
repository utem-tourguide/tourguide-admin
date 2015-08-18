<?php namespace tests\TourGuide\Support;

use Artisan;
use Illuminate\Foundation\Testing\TestCase;

class LaravelTestCase extends TestCase {

  /**
   * Creates the application.
   *
   * @return \Illuminate\Foundation\Application
   */
  public function createApplication() {
    putenv('DB_DEFAULT=sqlite_testing');

    $app = require __DIR__ . '/../../bootstrap/app.php';

    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

    return $app;
  }

}
