<?php namespace TourGuide\Http\Controllers;
use Illuminate\Http\Response;
use TourGuide\Models\Postal;
use TourGuide\Models\UbicacionTuristica;
use TourGuide\Models\Usuario;

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
    $datos = [
      'ubicaciones' => UbicacionTuristica::latest()->take(5)->get(),
      'postales'    => Postal::with('ubicacion')->latest()->take(5)->get(),
      'usuarios'    => Usuario::latest()->take(5)->get(),
    ];

    return view('dashboard.index', $datos);
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
