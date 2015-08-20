<?php namespace TourGuide\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Response;

/**
 * Esta clase puede usarse como middleware para asegurar que un conjunto de rutas no puedan ser
 * visitadas más que por usuarios administradores.
 *
 * @package TourGuide\Http\Middleware
 */
class AdminChecker {

  /**
   * Comprueba si el usuario actual es administrador. Si no es así, redirige a la página para
   * obtener la aplicación móvil de TourGuide. Este filtro no hace nada si la petición se genera
   * desde la aplicación móvil.
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
      $es_administrador = Auth::user()->rol_id == ROL_ADMINISTRADOR;

      return $es_administrador ? $next($request) : redirect()->route('obtener_app');
    }
  }

}
