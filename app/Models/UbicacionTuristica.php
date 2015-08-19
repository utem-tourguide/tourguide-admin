<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;
use TourGuide\Contracts\Validable;

class UbicacionTuristica extends Model implements Validable {

  protected $table = 'ubicaciones_turisticas';
  protected $fillable = ['nombre', 'localizacion'];

  public function postales() {
    return $this->hasMany('TourGuide\Models\Postal', 'ubicacion_id');
  }

  public function informaciones() {
    return $this->hasMany('TourGuide\Models\InformacionUbicacion', 'ubicacion_id');
  }

  public static function reglasParaCrear() {
   return ['nombre'       => 'required|unique:ubicaciones_turisticas,nombre',
           'localizacion' => 'required'];
  }

  public static function reglasParaActualizar() {
    $reglas = self::reglasParaCrear();
    $reglas['nombre'] = 'required';

    return $reglas;
  }
}
