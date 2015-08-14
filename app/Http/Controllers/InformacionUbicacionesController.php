<?php namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;
use TourGuide\Models\InformacionUbicacion;

class InformacionUbicacionesController extends RecursoController {

  /**
   * Devuelve las entradas de información de una ubicación
   *
   * @param int $ubicacion_id
   *
   * @return Response
   */
  public function index($ubicacion_id) {
    return InformacionUbicacion::where('ubicacion_id', $ubicacion_id)->get();
  }

  /**
   * Muestra el formulario para crear una nueva entrada de información sobre una ubicación
   *
   * @param int $ubicacion_id
   *
   * @return Response
   */
  public function create($ubicacion_id) {
    return view('ubicaciones.informacion.create');
  }

  /**
   * Almacena una nueva entrada de información para una ubicación en la base de datos
   *
   * @param Request $request
   * @param int     $ubicacion_id
   *
   * @return Response
   */
  public function store(Request $request, $ubicacion_id) {
    $datos = $request->all() + ['ubicacion_id' => $ubicacion_id];
    return InformacionUbicacion::create($datos);
  }


  /**
   * Muestra la entrada de información específicada.
   *
   * @param  int $ubicacion_id
   * @param  int $id
   *
   * @return Response
   */
  public function show($ubicacion_id, $id) {
    return InformacionUbicacion::find($id) ?: error_404();
  }

  /**
   * Muestra el formulario para editar una entrada de información acerca de una ubicación
   *
   * @param  int $ubicacion_id
   * @param  int $id
   *
   * @return Response
   */
  public function edit($ubicacion_id, $id) {
    $datos = [
      'informacion' => InformacionUbicacion::find($id),
    ];
    return view('ubicaciones.informacion.create', $datos);
  }

  /**
   * Actualiza la entrada de información específicada
   *
   * @param Request $request
   * @param  int    $ubicacion_id
   * @param  int    $id
   *
   * @return Response
   */
  public function update(Request $request, $ubicacion_id, $id) {
    $informacion = InformacionUbicacion::find($id);
    $informacion->update($request->all());
    $informacion->save();
    return $informacion;
  }

  /**
   * Elimina la entrada de información especificada
   *
   * @param  int $ubicacion_id
   * @param  int $id
   *
   * @return Response
   */
  public function destroy($ubicacion_id, $id) {
    $informacion = InformacionUbicacion::find($id) ?: App::abort(404);
    return $informacion->delete() ? response('', 200) : response('', 500);
  }

}
