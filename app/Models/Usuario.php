<?php namespace TourGuide\Models;

use Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use TourGuide\Contracts\Validable;

class Usuario extends Model implements Authenticatable, Validable {

  protected $fillable = [
                         'email',
                         'contrasena',
                         'nombre',
                         'apellido',
                         'idioma',
                        ];

  protected $hidden = ['contrasena_cifrada'];

  protected $appends = ['rol'];

  public static function reglasParaCrear() {
    return [
      'email'      => 'required|email|unique:usuarios,email',
      'contrasena' => 'required|min:5|confirmed',
      'nombre'     => 'required',
      'apellido'   => 'required',
      'idioma'     => 'required',
      'rol_id'     => 'required|numeric',
    ];
  }

  public static function reglasParaActualizar() {
    $reglas = self::reglasParaCrear();
    $reglas['email']      = 'required|email';
    $reglas['contrasena'] = 'sometimes|min:5|confirmed';
    $reglas['rol_id']     = 'sometimes|numeric';

    return $reglas;
  }

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

  public function nombreCompleto() {
    return $this->nombre . ' ' . $this->apellido;
  }

  /**
   * Get the unique identifier for the user.
   *
   * @return string
   */
  public function getAuthIdentifier() {
    return $this->attributes['id'];
  }

  /**
   * Get the password for the user.
   *
   * @return string
   */
  public function getAuthPassword() {
    return $this->attributes['contrasena_cifrada'];
  }

  /**
   * Get the token value for the "remember me" session.
   *
   * @return string
   */
  public function getRememberToken() {
    // TODO: Implement getRememberToken() method.
  }

  /**
   * Set the token value for the "remember me" session.
   *
   * @param  string $value
   *
   * @return void
   */
  public function setRememberToken($value) {
    // TODO: Implement setRememberToken() method.
  }

  /**
   * Get the column name for the "remember me" token.
   *
   * @return string
   */
  public function getRememberTokenName() {
    // TODO: Implement getRememberTokenName() method.
  }

}
