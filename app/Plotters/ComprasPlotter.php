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
      'labels' => $this->generateMonths($this->data),
      'datasets' => [
        ['data'       => $this->generateDataFromCompras($this->data),
         'fillColor'  => 'rgba(255, 128, 128, 0.4)'],
      ],
    ];
  }

  private function generateMonths($compras) {
    $meses = $compras->sortBy(function($compra) {
      return $compra->created_at->month;
    })->groupBy(function($compra) { return $compra->created_at->month; })
      ->keys();

    return $meses->map(function($mes) { return $this->MONTHS[$mes - 1]; });
  }

  /**
   * Genera un set de datos a partir de un set de compras.
   *
   * @param  Collection $compras
   * @return array
   */
  private function generateDataFromCompras($compras) {
    $meses = $compras->sortBy(function($compra) { return $compra->created_at->month; })
                     ->groupBy(function($compra) { return $compra->created_at->month; });

    return array_map(function($mes) { return sizeof($mes); }, array_values($meses->toArray()));
  }

}
