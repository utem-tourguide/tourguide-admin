<?php namespace TourGuide\Http\Controllers;
use Illuminate\Http\Response;

/**
 * Controlador para el dashboard de la aplicación.
 *
 * Este controlador atiende las peticiones relacionadas con el dashboard de la aplicación.
 *
 * @package TourGuide\Http\Controllers
 */
class DashboardController extends Controller {

  /**
   * Muestra el dashboard de la aplicación.
   *
   * @return Response
   */
  public function index() {
    return view('dashboard.index');
  }

  /**
   * Muestra la página para obtener la aplicación móvil.
   *
   * @return Response
   */
  public function android() {
    return view('dashboard.android');
  }

}
