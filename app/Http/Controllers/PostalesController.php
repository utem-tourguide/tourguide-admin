<?php namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use TourGuide\Http\Requests;
use TourGuide\Models\Postal;

class PostalesController extends RecursoController {

  /**
   * Muestra una lista de postales.
   * @return Response
   */
  public function index() {
    return Postal::all();
  }

  /**
   * Muestra el formulario para crear una postal nueva.
   *
   * @return Response
   */
  public function create() {
    return view('ubicaciones.postales.create');
  }

  /**
   * Almacena una postal en la base de datos.
   *
   * @param  int     $ubicacion_id
   * @param  Request $peticion
   * @return Response
   */
  public function store($ubicacion_id, Request $peticion) {
    $this->validate($peticion, Postal::reglasParaCrear());

    $datos  = $peticion->all() + ['ubicacion_id' => $ubicacion_id];
    $postal = Postal::create($datos);


    if ($peticion->hasFile('imagen')) $postal->guardarImagen($peticion->file('imagen'));

    return $postal;
  }

  /**
   * Muestra una postal especifica.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id) {
    return Postal::findOrFail($id);
  }

  /**
   * Remueve la postal específicada de la base de datos.
   *
   * @param  int $ubicacion_id
   * @param  int $id
   *
   * @return Response
   */
  public function destroy($ubicacion_id, $id) {
    $postal = Postal::findOrFail($id);

    $postal->eliminarImagen();
    $postal->delete();
  }

}
