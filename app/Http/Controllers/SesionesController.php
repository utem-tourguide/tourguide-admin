<?php namespace TourGuide\Http\Controllers;

use TourGuide\Http\Requests;
use TourGuide\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SesionesController extends Controller {

  /**
   * Muestra el formulario de inicio de sesión.
   *
   * @return Response
   */
  public function index()
  {
    return view('sesiones.iniciar_sesion');
  }

}
