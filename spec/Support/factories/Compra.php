<?php

use League\FactoryMuffin\Facade as FM;

FM::define('TourGuide\Models\Compra', [
  'usuario_id' => 'randomNumber',
  'postal_id'  => 'randomNumber',
  'created_at' => 'dateTimeThisYear',
]);
