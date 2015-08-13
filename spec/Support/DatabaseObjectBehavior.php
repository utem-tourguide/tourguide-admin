<?php namespace spec\TourGuide\Support;

use Artisan;

class DatabaseObjectBehavior extends LaravelObjectBehavior {

  public function let() {
    parent::let();

    Artisan::call('migrate');
  }

}
