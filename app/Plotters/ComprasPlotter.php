<?php namespace TourGuide\Plotters;

use Illuminate\Database\Eloquent\Collection;

/**
 * Genera información sobre un grupo de compras en un formato compatible con Chart.js.
 */
class ComprasPlotter extends Plotter {

  /**
   * Meses del año.
   *
   * @var array
   */
  private $MONTHS = ['Enero',
                     'Febrero',
                     'Marzo',
                     'Abril',
                     'Mayo',
                     'Junio',
                     'Julio',
                     'Agosto',
                     'Septiembre',
                     'Octubre',
                     'Noviembre',
                     'Diciembre'];

  /**
   * Devuelve información sobre compras en formato compatible con Chart.js.
   *
   * @return array
   */
  public function getData() {
    return [
      'labels' => $this->generateLabels($this->data),
      'datasets' => [
        ['data'       => $this->generateDataFromCompras($this->data),
         'fillColor'  => 'rgba(255, 128, 128, 0.4)'],
      ],
    ];
  }

  /**
   * @param Collection $compras
   *
   * @return array
   */
  private function generateLabels($compras) {
    return $this->groupComprasByMonthAndYear($compras)->keys()->toArray();
  }

  /**
   * Genera un set de datos a partir de un set de compras.
   *
   * @param  Collection $compras
   *
   * @return array
   */
  private function generateDataFromCompras($compras) {
    $meses = $this->groupComprasByMonthAndYear($compras);

    return array_map(function($mes) { return sizeof($mes); }, array_values($meses->toArray()));
  }

  /**
   * Agrupa un set de compras por mes y año.
   *
   * @param $compras
   *
   * @return Collection
   */
  private function groupComprasByMonthAndYear($compras) {
    $meses = $compras->sortBy('created_at')
                     ->groupBy(function($compra) {
                       $mes = $this->MONTHS[$compra->created_at->month - 1];

                       return $mes.' '.$compra->created_at->year;
                     });

    return $meses;
  }

}
