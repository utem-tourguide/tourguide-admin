<?php namespace TourGuide\Http\Controllers;

class AdministradorController extends Controller {

  public function ubicaciones() {
    return view('ubicaciones.index');
  }

  public function usuarios(){
  	return view('usuarios.index');
  }
}