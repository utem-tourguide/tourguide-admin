<?php namespace TourGuide\Http\Controllers;

class AdministradorController extends Controller {

  public function ubicaciones() {
    return view('ubicaciones.index');
  }

}
