<?php namespace TourGuide\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use TourGuide\Models\Compra;
use TourGuide\Plotters\ComprasPlotter;

class ComprasController extends Controller {

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
   * @return Response
   */
  public function index(Request $peticion) {
    $fecha_desde = new Carbon($peticion->get('desde'));
    $fecha_hasta = new Carbon($peticion->get('hasta'));
    $compras = Compra::where('created_at', '>=', $fecha_desde->toDateString())
                     ->where('created_at', '<=', $fecha_hasta->toDateString())
                     ->get();

    return with(new ComprasPlotter($compras))->getData();
  }

  public function store(Request $request) {
    if ( ! $request->has(['usuario_id', 'postal_id'])) {
      return response('', 422);
    }

    $compra = new Compra($request->only(['usuario_id', 'postal_id']));
    $compra->save();

    return response($compra, 201);
  }

}
