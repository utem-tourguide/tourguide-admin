<?php

namespace spec\TourGuide\Plotters;

use Illuminate\Support\Collection;
use League\FactoryMuffin\Facade as FM;
use spec\TourGuide\Support\DatabaseObjectBehavior;

/**
 * @package spec\TourGuide\Plotters
 */
class ComprasPlotterSpec extends DatabaseObjectBehavior {

  public function it_devuelve_un_set_de_compras_en_el_formato_esperado() {
    $compras = new Collection([
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2015-01-01 00:00:00']),
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2015-02-01 00:00:00']),
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2015-02-01 00:00:00']),
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2015-03-01 00:00:00']),
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2015-03-01 00:00:00']),
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2015-03-01 00:00:00']),
    ]);

    $this->beConstructedWith($compras);

    $this->getData()->shouldBeLike([
      'labels'   => ['Enero 2015', 'Febrero 2015', 'Marzo 2015'],
      'datasets' => [
        [
          'data'      => [1, 2, 3],
          'fillColor' => 'rgba(255, 128, 128, 0.4)',
        ],
      ],
    ]);
  }

  public function it_puede_representar_compras_de_diversos_años_sin_problema() {
    $compras = new Collection([
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2013-01-01 00:00:00']),
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2014-02-01 00:00:00']),
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2014-02-01 00:00:00']),
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2015-01-01 00:00:00']),
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2015-01-01 00:00:00']),
      FM::instance('TourGuide\Models\Compra', ['created_at' => '2015-01-01 00:00:00']),
    ]);

    $this->beConstructedWith($compras);

    $this->getData()->shouldBeLike([
      'labels'   => ['Enero 2013', 'Febrero 2014', 'Enero 2015'],
      'datasets' => [
        [
          'data'      => [1, 2, 3],
          'fillColor' => 'rgba(255, 128, 128, 0.4)',
        ],
      ],
    ]);
  }

}
