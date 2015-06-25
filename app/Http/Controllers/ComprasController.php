<?php namespace TourGuide\Http\Controllers;

use TourGuide\Models\Compra;

class ComprasController extends Controller {

	public function index() {
		$compras = Compra::all();
		$datos = ['compras' => $compras];
		return view('compras.index', $datos);
	}

}
