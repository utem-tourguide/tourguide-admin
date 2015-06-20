<?php namespace TourGuide\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

  protected $fillable = [
                         'email',
                         'contrasena_cifrada',
                         'nombre',
                         'apellido',
                         'idioma',
                         'rol_id',
                        ];

  /**
   * Cifra una contraseña en texto plano y devuelve su versión cifrada.
   *
   * @param string $contrasena
   * @return string
   */
  public static function cifrarContrasena($contrasena) {
    $factor_cifrado = 31;
    $salt = "$2y$$factor_cifrado" . substr(md5(uniqid(rand(), true)), 0, 22);
    return crypt($contrasena, $salt);
  }

  /**
   * Verifica la contraseña de un usuario.
   *
   * @param  string $contraseña
   * @return boolean
   */
  public function verificarContrasena($contrasena) {
    $version_cifrada = crypt($contrasena, $this->contrasena_cifrada);
    return $version_cifrada === $this->contrasena_cifrada;
  }

}
