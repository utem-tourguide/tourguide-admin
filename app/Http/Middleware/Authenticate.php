<?php namespace TourGuide\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Response;

class Authenticate {

  /**
   * Comprueba si existe una sesión iniciada. Si no existe, redirige a la página de inicio de
   * sesión.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   *
   * @return Response
   */
  public function handle($request, Closure $next) {
    return Auth::check() ? $next($request) : redirect()->route('login');
  }

}
