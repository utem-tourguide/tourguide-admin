<?php namespace TourGuide\Http\Controllers;

/**
 * Clase base para los controladores de recursos.
 *
 * Esta clase ayuda a centralizar la lógica que debe aplicarse en todos los controladores de
 * recursos. Esta clase no puede instanciarse directamente.
 *
 * @package TourGuide\Http\Controllers
 */
abstract class RecursoController extends Controller {

  /**
   * Construye una instancia de este controller. Este método asegura que las acciones "store",
   * "update" y "destroy" estén protegidas por un filtro csrf.
   */
  public function __construct() {
    $this->middleware('csrf', ['only' => ['store', 'update', 'destroy']]);
  }

}
