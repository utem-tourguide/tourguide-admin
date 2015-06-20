<?php namespace TourGuide\Http\Controllers;

use Input;
use Session;
use TourGuide\Models\Usuario;
use TourGuide\Http\Controllers\Controller;

class SesionesController extends Controller {

  /**
   * Muestra el formulario de inicio de sesión.
   *
   * @return Response
   */
  public function index() {
    return view('sesiones.iniciar_sesion');
  }

  /**
   * Recibe el formulario de inicio de sesión e inicia sesión si las
   * credenciales son correctas.
   *
   * @return Response
   */
  public function entrar() {
    $usuario = Usuario::whereEmail( Input::get('email') )->first();
    if ($usuario && $usuario->verificarContrasena( Input::get('contrasena') )) {
      Session::put('usuario_id', $usuario->id);
      return $this->redirigir_a_dashboard_si_es_administrador($usuario);
    } else {
      return redirect()->route('sesiones.entrar')
                       ->with('error', 'Usuario o contraseña incorrectos.');
    }
  }

  /**
   * Cierra la sesión actual en la aplicación.
   *
   * @return Response
   */
  public function salir() {
    Session::flush();
    return redirect()->route('sesiones.entrar');
  }

  /**
   * Genera una redirección hacia el dashboard si el usuario especificado es un
   * administrador. Si el usuario no es administrador, se le redirige a la
   * página con instrucciones para obtener la aplicación móvil de TourGuide.
   *
   * @param  TourGuide\Models\Usuario $usuario
   * @return Response
   */
  private function redirigir_a_dashboard_si_es_administrador($usuario) {
    if ($usuario->rol_id == ROL_ADMINISTRADOR) {
      return redirect()->route('dashboard');
    } else {
      return redirect()->route('obtener_app');
    }
  }

}
