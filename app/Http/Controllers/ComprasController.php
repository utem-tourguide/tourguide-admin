<?php namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;
use TourGuide\Models\Compra;

class ComprasController extends Controller {

	public function index() {
		$compras = Compra::all();
		$datos = ['compras' => $compras];
		return view('compras.index', $datos);
	}

  public function store(Request $request) {
    $compra = new Compra($request->only(['usuario_id', 'postal_id']));
    $compra->save();

    return response($compra, 201);
  }

}
