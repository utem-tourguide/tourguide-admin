<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;

class UbicacionTuristica extends Model {

  protected $table = 'ubicaciones_turisticas';
  protected $fillable = ['nombre', 'localizacion'];

  public function postales() {
    return $this->hasMany('TourGuide\Models\Postal', 'ubicacion_id');
  }

  public function informaciones() {
    return $this->hasMany('TourGuide\Models\InformacionUbicacion', 'ubicacion_id');
  }

}
