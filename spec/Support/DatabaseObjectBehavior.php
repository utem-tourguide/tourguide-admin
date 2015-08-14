<?php namespace spec\TourGuide\Support;

use Artisan;

class DatabaseObjectBehavior extends LaravelObjectBehavior {

  public function let() {
    parent::let();

    copy(base_path('.db_base.sqlite'), base_path('testing.sqlite'));
  }

  public function letGo() {
    unlink(base_path('testing.sqlite'));
  }

}
