<?php namespace TourGuide\Http\Middleware;

use Closure;

class Authenticate {

  /**
   * Comprueba si existe una sesión iniciada. Si no existe, redirige a la página
   * de inicio de sesión.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
    if (Session::has( 'usuario_id' )) {
      // La petición sigue adelante...
      return $next($request);
    } else {
      return redirect()->route('sesiones.entrar');
    }
  }

}
