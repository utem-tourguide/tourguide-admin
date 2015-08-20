<?php namespace TourGuide\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Response;

class Authenticate {

  /**
   * Comprueba si existe una sesión iniciada. Si no existe, redirige a la página de inicio de
   * sesión. Este filtro no hace nada si la petición se genera desde la aplicación móvil.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   *
   * @return Response
   */
  public function handle($request, Closure $next) {
    if ($request->ajax() || $request->wantsJson()) {
      return $next($request);
    } else {
      return Auth::check() ? $next($request) : redirect()->route('login');
    }
  }

}
