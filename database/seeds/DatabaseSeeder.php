<?php

use App\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');

		Usuario::create(['email'              => 'kevindperezm@gmail.com',
			               'contrasena_cifrada' => 'asdfg',
			               'nombre'             => 'Kevin',
			               'apellido'           => 'Perez',
			               'idioma'             => 'es',
			               'rol_id'             => 1]);
	}

}
