<?php namespace TourGuide\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use TourGuide\Models\Compra;
use TourGuide\Models\UbicacionTuristica;
use TourGuide\Plotters\ComprasPlotter;

class ComprasController extends RecursoController {

  /**
   * Devuelve la lista de compras de postales de una ubicación.
   *
   * Este método genera una lista de compras obtenidas de la base de datos que se encuentren dentro
   * de un rango de fechas específicadas.
   *
   * La fecha de inicio del rango debe especificarse como el parámetro GET 'desde' y la fecha de
   * término del rango como el parámetro GET 'hasta'. Ambas fechas deben especificarse en el
   * formato YYYY-MM-DD.
   *
   * @param  Request $peticion
   *
   * @return Response
   */
  public function index(Request $peticion) {
    return with(new ComprasPlotter($this->obtenerCompras($peticion)))->getData();
  }

  /**
   * @param Request $request
   *
   * @return Response
   */
  public function store(Request $request) {
    if ( ! $request->has(['usuario_id', 'postal_id'])) {
      return response('', 422);
    }

    $compra = new Compra($request->only(['usuario_id', 'postal_id']));
    $compra->save();

    return response($compra, 201);
  }

  /**
   * @param Request $peticion
   *
   * @return Collection
   */
  private function obtenerCompras($peticion) {
    $fecha_desde  = new Carbon($peticion->get('desde'));
    $fecha_hasta  = new Carbon($peticion->get('hasta'));
    $ubicacion_id = $peticion->get('ubicacion_id');

    $compras_query = Compra::where('created_at', '>=', $fecha_desde->toDateString())
                           ->where('created_at', '<=', $fecha_hasta->toDateString());

    if ($ubicacion_id && $ubicacion_id != 0) {
      $ubicacion = UbicacionTuristica::find($ubicacion_id);
      $postales_ids = $ubicacion->postales->map(function($postal) { return $postal->id; });
      $compras_query = $compras_query->whereIn('postal_id', $postales_ids);
    }

    return $compras_query->get();
  }

}
