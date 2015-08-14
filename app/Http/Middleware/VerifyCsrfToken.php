<?php namespace TourGuide\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

  /**
   * Verifica la presencia del token anti CSRF. Este filtro no aplica para las peticiones AJAX o
   * las peticiones que soliciten JSON explícitamente.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)	{
    if ($request->ajax() || $request->wantsJson()) {
      return $next($request);
    } else {
      return parent::handle($request, $next);
    }
  }

}
