<?php

use TourGuide\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsuariosSeeder extends Seeder {

  /**
   * Inserta los primeros usuarios en la base de datos.
   *
   * @return void
   */
  public function run()
  {
    Usuario::create(['email'              => 'kevindperezm@tourguide.com',
                     'contrasena_cifrada' => Usuario::cifrarContrasena('asdfg'),
                     'nombre'             => 'Kevin',
                     'apellido'           => 'Perez',
                     'idioma'             => 'es',
                     'rol_id'             => 1]);
  }

}
