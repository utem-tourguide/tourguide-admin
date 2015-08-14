<?php

return [

  'fetch' => PDO::FETCH_CLASS,
  'default' => env('DB_DEFAULT', 'tourguide'),
  'migrations' => 'migraciones',

  'connections' => [
    'tourguide' => [
      'driver'    => env('DB_DRIVER', 'sqlite'),
      'host'      => env('DB_HOST', 'localhost'),
      'database'  => env('DB_DATABASE', base_path().'/db.sqlite'),
      'username'  => env('DB_USERNAME', 'tourguide'),
      'password'  => env('DB_PASSWORD', ''),
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'strict'    => false,
    ],
    'sqlite_testing' => [
      'driver'   => 'sqlite',
      'database' => base_path('testing.sqlite'),
    ],
    'sqlite_acceptance' => [
      'driver'   => 'sqlite',
      'database' => base_path('acceptance.sqlite'),
    ],
    'sqlite_base' => [
      'driver'   => 'sqlite',
      'database' => base_path('.db_base.sqlite'),
    ]
  ],

];
