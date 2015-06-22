<?php namespace TourGuide\Tests;

use PHPUnit_Framework_Assert as PHPUnit;

trait CustomAssertions {

  /**
   * Comprueba que no se haya redirigido hacia una URI.
   *
   * @param string $uri
   * @param array  $with
   */
  public function assertNotRedirectedTo($uri, $with = []) {
    PHPUnit::assertInstanceOf('Illuminate\Http\RedirectResponse',
                              $this->response);
    PHPUnit::assertNotEquals($this->app['url']->to($uri),
                          $this->response->headers->get('Location'));
    $this->assertSessionHasAll($with);
  }

  /**
   * Comprueba que no se haya redirigido hacia una ruta.
   *
   * @param type $name
   * @param type $parameters
   * @param type $with
   */
  public function assertNotRedirectedToRoute($name, $parameters = [], $with = []) {
    $this->assertNotRedirectedTo($this->app['url']->route($name, $parameters),
                                 $with);
  }

}
