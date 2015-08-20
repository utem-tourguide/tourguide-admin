<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use TourGuide\Contracts\Validable;

class Postal extends Model implements Validable {

  const IMAGENES_PATH = 'images/postales';

  /**
   * La tabla donde se almacenan las postales en la base de datos.
   * @var string
   */
  protected $table = 'postales';

  /**
   * Los atributos que pueden asignarse masivamente.
   * @var array
   */
  protected $fillable = ['precio',
                         'ubicacion_id'];

  public static function reglasParaCrear() {
    return [
      'imagen' => 'required|max:5000|mimes:jpg,jpeg,png,gif',
      'precio' => 'required|numeric',
    ];
  }

  public static function reglasParaActualizar() {
    return [];
  }

  /**
   * @return float
   */
  public function getPrecioAttribute() {
    return number_format($this->attributes['precio'], 2);
  }

  /**
   * @param UploadedFile $imagen_archivo
   */
  public function guardarImagen($imagen_archivo) {
    $imagen_archivo->move(self::IMAGENES_PATH, $this->id);
  }

  public function eliminarImagen() {
    $path = self::IMAGENES_PATH."/{$this->id}";
    if (file_exists($path)) unlink($path);
  }

  /**
   * @return string
   */
  public function obtenerImagenUrl() {
    return asset(self::IMAGENES_PATH."/{$this->id}");
  }

  public function ubicacion() {
    return $this->belongsTo('TourGuide\Models\UbicacionTuristica', 'ubicacion_id');
  }

}
