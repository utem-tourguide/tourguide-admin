<?php

namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use TourGuide\Http\Requests;
use TourGuide\Models\UbicacionTuristica;
use TourGuide\Http\Controllers\Controller;

class UbicacionesController extends Controller {

  /**
   * Lista las ubicaciones turísticas
   *
   * @return Response
   */
  public function index() {
    return UbicacionTuristica::all();
  }

  /**
   * Muestra el formulario para crear una ubicación turística.
   *
   * @return Response
   */
  public function create() {
    return view('ubicaciones.create');
  }

  /**
   * Almacena una nueva ubicación turística en la base de datos.
   *
   * @return Response
   */
  public function store() {
    return UbicacionTuristica::create(Input::all());
  }


  /**
   * Muestra una ubicación turística en especifico
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id) {
    return UbicacionTuristica::find($id) ?: error_404();
  }

  /**
   * Muestra un formulario para editar una ubicación turística
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id) {
    $datos = UbicacionTuristica::find($id);
    $ubicaciones = ['ubicaciones' => $datos];
    return view('ubicaciones.edit', $ubicaciones);
  }

  /**
   * Actualiza la ubicación turística espećíficada en la base de datos
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id) {
    $ubicacion = UbicacionTuristica::find($id);
    $ubicacion -> update( array('nombre' => Input::get('nombre'), 'localizacion'=> Input::get('localizacion')));
    $ubicacion -> save();
    return $ubicacion;
  }

  /**
   * Remueve una ubicación turística
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id) {
    $ubicacion = User::find($id);

    if (is_null ($ubicacion)) {
      App::abort(404);
    }

    $ubicacion->delete();

    if (Request::ajax()) {
      return Response::json(array (
        'success' => true,
        'msg'     => 'ubicacion ' . $ubicacion->full_name . ' eliminado',
        'id'      => $ubicacion->id
        ));
    } else {
      return Redirect::route('administrar.ubicaciones.index');
    }
  }

}
