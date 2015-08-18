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
   * obtener la aplicación móvil de TourGuide.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   *
   * @return Response
   */
  public function handle($request, Closure $next) {
    $es_administrador = Auth::user()->rol_id == ROL_ADMINISTRADOR;

    return $es_administrador ? $next($request) : redirect()->route('obtener_app');
  }

}
