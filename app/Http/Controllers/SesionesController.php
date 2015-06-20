<?php namespace TourGuide\Http\Controllers;

use Input;
use Session;
use TourGuide\Http\Requests;
use TourGuide\Models\Usuario;
use TourGuide\Http\Controllers\Controller;

use Illuminate\Http\Request;

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
      /* TODO: Mostrar dashboard */
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
