<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;

class Postal extends Model {

  /**
   * Los atributos que pueden asignarse masivamente.
   * @var array
   */
  protected $fillable = ['imagen_url',
                         'precio',
                         'ubicacion_id'];

}
