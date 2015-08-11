<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;

class UbicacionTuristica extends Model {

  protected $table = 'ubicaciones_turisticas';
  protected $fillable = ['nombre', 'localizacion'];

}
