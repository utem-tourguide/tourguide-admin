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
      return redirect()->route('dashboard');
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

}
