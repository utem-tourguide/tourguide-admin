<?php namespace TourGuide\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Response;
use TourGuide\Models\UbicacionTuristica;

class AdministradorController extends Controller {

  public function compras() {
    $datos = ['fecha_desde' => with(new Carbon)->startOfYear(),
              'fecha_hasta' => with(new Carbon)->endOfYear(),
              'ubicaciones' => $this->construirSelectDeUbicaciones()];

    return view('compras.index', $datos);
  }

  public function ubicaciones() {
    return view('ubicaciones.index');
  }

  public function informacion($ubicacion_id) {
    $datos = [
      'ubicacion' => UbicacionTuristica::find($ubicacion_id),
    ];

    return view('ubicaciones.informacion.index', $datos);
  }

  /**
   * Muestra la página para administrar postales
   *
   * @param  int $ubicacion_id
   *
   * @return Response
   */
  public function postales($ubicacion_id) {
    $datos = ['ubicacion' => UbicacionTuristica::find($ubicacion_id)];

    return view('ubicaciones.postales.index', $datos);
  }

  public function usuarios(){
  	return view('usuarios.index');
  }

  /**
   * @return array
   */
  private function construirSelectDeUbicaciones() {
    $ubicaciones = [0 => 'Todas'];
    UbicacionTuristica::all()->each(function($ubicacion) use (&$ubicaciones) {
      $ubicaciones[$ubicacion->id] = "$ubicacion->nombre, $ubicacion->localizacion";
    });

    return $ubicaciones;
  }

}
