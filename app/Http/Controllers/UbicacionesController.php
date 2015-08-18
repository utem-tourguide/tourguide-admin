<?php

namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use TourGuide\Http\Requests;
use TourGuide\Models\UbicacionTuristica;
use TourGuide\Http\Controllers\Controller;

class UbicacionesController extends RecursoController {

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
   * @param Request $peticion
   *
   * @return Response
   */
  public function store(Request $peticion) {
    $this->validate($peticion, UbicacionTuristica::$reglas);

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
    $datos = ['ubicacion' => UbicacionTuristica::find($id)];

    return view('ubicaciones.create', $datos);
  }

  /**
   * Actualiza la ubicación turística espećíficada en la base de datos
   *
   * @param int     $id
   * @param Request $peticion
   *
   * @return Response
   */
  public function update($id, Request $peticion) {
    $this->validate($peticion, UbicacionTuristica::$reglas);

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
    if ($ubicacion = UbicacionTuristica::find($id)) {
      $ubicacion->delete();
    } else {
      return response('')->status(404);
    }
  }

}
