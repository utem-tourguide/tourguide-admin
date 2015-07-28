<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionUbicacion extends Model {

  protected $table = 'informacion_de_ubicaciones';
  protected $fillable = ['idioma',
                         'contenido',
                         'ubicacion_id'];

  public function ubicacion() {
    return $this->belongsTo('TourGuide\Models\Ubicacion');
  }

}
