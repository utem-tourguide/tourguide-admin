<?php namespace TourGuide\Models;

use Hash;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

  protected $fillable = [
                         'email',
                         'contrasena',
                         'nombre',
                         'apellido',
                         'idioma',
                        ];

  protected $hidden = ['contrasena_cifrada'];

  protected $appends = ['rol'];

  /**
   * Obtiene el rol del usuario como una cadena de texto.
   *
   * @return string
   */
  public function getRolAttribute() {
    $roles = [ROL_ADMINISTRADOR => 'administrador',
              ROL_TURISTA       => 'turista'];

    return $roles[$this->attributes['rol_id']];
  }

  public function getIdiomaAttribute() {
    $idiomas = ['en' => 'inglés',
                'es' => 'español',
                'fr' => 'francés'];

    return $idiomas[$this->attributes['idioma']];
  }

  /**
   * Coloca una versión cifrada de la contraseña especificada.
   *
   * @param string $valor Contraseña sin cifrar
   */
  public function setContrasenaAttribute($valor) {
    $this->attributes['contrasena_cifrada'] = Hash::make($valor);
  }

  /**
   * Verifica la contraseña de un usuario.
   *
   * @param  string $contrasena
   * @return boolean
   */
  public function verificarContrasena($contrasena) {
    return Hash::check($contrasena, $this->attributes['contrasena_cifrada']);
  }

  public function nombre_completo() {
    return $this->nombre . ' ' . $this->apellido;
  }

}
