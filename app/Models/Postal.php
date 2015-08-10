<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

  /**
   * @param UploadedFile $imagen_archivo
   */
  public function guardarImagen($imagen_archivo) {
    $imagen_archivo->move(public_path('images/postales'), $this->id);
  }

  /**
   * @return string
   */
  public function obtenerImagenUrl() {
    return asset("images/postales/{$this->id}");
  }

}
