<?php namespace TourGuide\Http\Controllers;

use Illuminate\Http\Response;
use Auth;
use Session;
use Illuminate\Http\Request;
use TourGuide\Models\Usuario;
use TourGuide\Http\Controllers\Controller;

/**
 * Controlador de sesiones
 */
class SesionesController extends RecursoController {

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
   * @param Request $request
   *
   * @return Response
   */
  public function store(Request $request) {
    $credenciales = ['email'    => $request->get('email'),
                     'password' => $request->get('contrasena')];
    if (Auth::attempt($credenciales)) {
      return $this->mostrarPaginaDeInicio($request, Auth::user());
    } else {
      return $this->mostrarUsuarioInvalido($request);
    }
  }

  /**
   * Cierra la sesión actual en la aplicación.
   *
   * @return Response
   */
  public function destroy() {
    Auth::logout();

    return redirect()->route('login');
  }

  /**
   * @param Request $req
   * @param         $usuario
   *
   * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
   */
  private function mostrarPaginaDeInicio(Request $req, $usuario) {
    if ($req->wantsJson()) {
      return response()->json($usuario);
    } else {
      return $this->mostrarPaginaDeInicioSegunRol($usuario);
    }
  }

  /**
   * @param $usuario
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  private function mostrarPaginaDeInicioSegunRol($usuario) {
    if ($usuario->rol_id == ROL_ADMINISTRADOR) {
      return redirect()->route('dashboard');
    } else {
      return redirect()->route('obtener_app');
    }
  }

  /**
   * @param Request $request
   *
   * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   */
  private function mostrarUsuarioInvalido(Request $request) {
    if ($request->wantsJson()) {
      return response('Unauthorized', 401);
    } else {
      return redirect()
        ->route('login')
        ->with('error', 'Usuario o contraseña incorrectos.');
    }
  }

}
