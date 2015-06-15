<?php

return [

  'fetch' => PDO::FETCH_CLASS,
  'default' => 'tourguide',
  'migrations' => 'migraciones',

  'connections' => [
    'tourguide' => [
      'driver'    => env('DB_DRIVER', 'sqlite'),
      'host'      => env('DB_HOST', 'localhost'),
      'database'  => env('DB_DATABASE', 'db.sqlite'),
      'username'  => env('DB_USERNAME', 'tourguide'),
      'password'  => env('DB_PASSWORD', ''),
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
      'strict'    => false,
    ],
  ],

];
