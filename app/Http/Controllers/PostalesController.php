<?php namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;
use TourGuide\Http\Requests;
use TourGuide\Http\Controllers\Controller;
use TourGuide\Models\Postal;

class PostalesController extends Controller {

  /**
   * Muestra una lista de postales.
   *
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
    return view('postales.create');
  }

  /**
   * Almacena una postal en la base de datos.
   *
   * @param Request $peticion
   * @return Response
   */
  public function store(Request $peticion) {
    return Postal::create($peticion->all());
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
   * Muestra el formulario para editar una postal en la base de datos.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id) {
    $datos = ['postal' => Postal::findOrFail($id)];

    return view('postales.create', $datos);
  }

  /**
   * Actualiza una postal almacenada en la base de datos.
   *
   * @param Request $peticion
   * @param  int  $id
   * @return Response
   */
  public function update(Request $peticion, $id) {
    $postal = Postal::findOrFail($id);
    $postal->update($peticion->all());

    return $postal;
  }

  /**
   * Remueve la postal específicada de la base de datos.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id) {
    $postal = Postal::findOrFail($id);

    return $postal->delete();
  }

}
