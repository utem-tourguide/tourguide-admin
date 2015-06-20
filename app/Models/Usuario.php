<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

  protected $fillable = [
                         'email',
                         'contrasena_cifrada',
                         'nombre',
                         'apellido',
                         'idioma',
                         'rol_id',
                        ];

}
