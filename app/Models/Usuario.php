<?php namespace TourGuide\Models;

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
   * Coloca una versión cifrada de la contraseña especificada.
   *
   * @param string $valor Contraseña sin cifrar
   */
  public function setContrasenaAttribute($valor) {
    $this->attributes['contrasena_cifrada'] = self::cifrarContrasena($valor);
  }

  /**
   * Verifica la contraseña de un usuario.
   *
   * @param  string $contrasena
   * @return boolean
   */
  public function verificarContrasena($contrasena) {
    $version_cifrada = crypt($contrasena, $this->contrasena_cifrada);
    return $version_cifrada === $this->contrasena_cifrada;
  }

}
