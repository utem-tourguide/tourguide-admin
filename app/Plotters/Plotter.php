<?php namespace TourGuide\Plotters;

/**
 * Clase padre de todos los plotters.
 */
abstract class Plotter {

  /**
   * Datos a partir de los cuales producir la salida del plotter.
   *
   * @var mixed
   */
  protected $data;

  public function __construct($data) {
    $this->data = $data;
  }

  /**
   * Devuelve los datos generados por el plotter.
   *
   * @return mixed
   */
  public abstract function getData();

}
