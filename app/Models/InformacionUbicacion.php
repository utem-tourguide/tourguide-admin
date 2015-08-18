<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;
use TourGuide\Contracts\Validable;

class InformacionUbicacion extends Model implements Validable {

  protected $table = 'informacion_de_ubicaciones';
  protected $fillable = ['idioma',
                         'contenido',
                         'ubicacion_id'];

  public function ubicacion() {
    return $this->belongsTo('TourGuide\Models\UbicacionTuristica');
  }

  public static function reglasParaCrear() {
    return ['contenido'    => 'required',
            'idioma'       => 'required'];
  }

  public static function reglasParaActualizar() {
    return self::reglasParaCrear();
  }
}
