<?php namespace TourGuide\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

  /**
   * The application's global HTTP middleware stack.
   *
   * @var array
   */
  protected $middleware = [
    'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
    'Illuminate\Cookie\Middleware\EncryptCookies',
    'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
    'Illuminate\Session\Middleware\StartSession',
    'Illuminate\View\Middleware\ShareErrorsFromSession',
  ];

  /**
   * The application's route middleware.
   *
   * @var array
   */
  protected $routeMiddleware = [
    'auth'        => 'TourGuide\Http\Middleware\Authenticate',
    'auth.basic'  => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
    'guest'       => 'TourGuide\Http\Middleware\RedirectIfAuthenticated',
    'csrf'        => 'TourGuide\Http\Middleware\VerifyCsrfToken',
    'only_admins' => 'TourGuide\Http\Middleware\AdminChecker',
  ];

}
