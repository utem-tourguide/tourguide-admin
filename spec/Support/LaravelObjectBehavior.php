<?php namespace spec\TourGuide\Support;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;

class LaravelObjectBehavior extends ObjectBehavior {

  public function let() {
    putenv('DB_DEFAULT=sqlite_testing');

    $unitTesting = true;
    $testEnvironment = 'testing';

    $app = require __DIR__.'/../../bootstrap/app.php';

    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
  }

}
