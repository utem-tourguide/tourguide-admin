<?php namespace TourGuide\Http\Controllers;

use TourGuide\Models\UbicacionTuristica;

class AdministradorController extends Controller {

  public function ubicaciones() {
    return view('ubicaciones.index');
  }

  public function informacion($ubicacion_id) {
    $datos = [
      'ubicacion' => UbicacionTuristica::find($ubicacion_id),
    ];

    return view('ubicaciones.informacion.index', $datos);
  }

}
