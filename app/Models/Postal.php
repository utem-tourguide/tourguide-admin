<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;

class Postal extends Model {

  /**
   * La tabla donde se almacenan las postales en la base de datos.
   * @var string
   */
  protected $table = 'postales';

  /**
   * Los atributos que pueden asignarse masivamente.
   * @var array
   */
  protected $fillable = ['imagen_url',
                         'precio',
                         'ubicacion_id'];

}
