<?php

use TourGuide\Models\Usuario;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Mink\Exception\ElementNotFoundException;

class FeatureContext extends MinkContext {

  /**
   * @BeforeScenario
   */
  public function preparar_bd() {
    Artisan::call('migrate');
    Artisan::call('db:seed');
  }

  /**
   * @Given /^que visito "(\S+)"$/
   * @When /^visito "(.*)"$/
   */
  public function visitar_url($url) {
    $this->getSession()->visit($url);
  }

  /**
   * @Given /^que existe el usuario "(.*)"$/
   * @When /^existe el usuario "(.*)"$/
   */
  public function crear_usuario($usuario) {
    Usuario::create($this->obtener_usuarios()[$usuario]);
  }

  /**
   * @When /^escribo "(.*)" en el campo "(.*)"$/
   */
  public function escribir_en_campo($valor, $campo) {
    $pagina = $this->getSession()->getPage();
    $pagina->fillField($campo, $valor);
  }

  /**
   * @When /^hago clic en "(.*)"$/
   */
  public function hacer_clic($locator) {
    $elemento = $this->encontrar_cliqueable($locator);
    $elemento->click();
  }

  /**
   * @Then /^debería estar en (.*)$/
   */
  public function verificar_url($url) {
    $this->assertUrlRegExp($url);
  }

  /**
   * @Then /^debería ver "(.*)"$/
   */
  public function verificar_texto_en_pagina($texto) {
    $this->assertPageContainsText($texto);
  }

  /**
   * Encuentra un elemento cliqueable en la página. Lanza una excepción si el
   * el elemento no es encontrado.
   *
   * @param  string $locator
   * @return Behat\Mink\Element
   * @throws Behat\Mink\Exception\ElementNotFoundException
   */
  private function encontrar_cliqueable($locator) {
    $pagina = $this->getSession()->getPage();
    $elemento = $pagina->findButton($locator);
    if ( ! $elemento) { $elemento = $pagina->findLink($locator); }
    if ( ! $elemento) {
      throw new ElementNotFoundException($this->getSession());
    }

    return $elemento;
  }

  /**
   * Devuelve un array con datos de usuarios de pruebas.
   *
   * @return array
   */
  private function obtener_usuarios() {
    return [
      'turista' => [
        'email'              => 'turista@tourguide.com',
        'contrasena_cifrada' => Usuario::cifrarContrasena('turista'),
        'nombre'             => 'Turista',
        'apellido'           => 'de pruebas',
        'idioma'             => 'es',
        'rol_id'             => ROL_TURISTA,
      ],
    ];
  }

}
