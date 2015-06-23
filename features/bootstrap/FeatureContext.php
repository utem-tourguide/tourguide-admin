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
   * @Given /^(?:que )?visita la página (?:para|de) (.*)$/
   */
  public function visitar_pagina($pagina) {
    $url = $this->obtener_url_para_pagina($pagina);
    $this->visitar_url($url);
  }

  /**
   * @Given /^(?:que )?visita "(\S+)"$/
   */
  public function visitar_url($url) {
    $this->getSession()->visit($url);
  }

  /**
   * @Given /^(?:que )?(.*) se registra como (.*) y accede$/
   */
  public function registrar_y_acceder($email, $rol) {
    $this->registrar_usuario($email, 'admin', $rol);
    $this->iniciar_sesion($email);
  }

  /**
   * @Given /^(?:que )?(.*) inicia sesión$/
   */
  public function iniciar_sesion($email) {
    $this->visitar_url(route( 'sesiones.entrar' ));
    $this->escribir_en_campo($email, 'email');
    $this->escribir_en_campo('admin', 'contrasena');
    $this->hacer_clic('Entrar');
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
   * @Then /^debería estar en la página (?:para|del) (.*)$/
   */
  public function verificar_pagina($pagina) {
    $url_regexp = $this->obtener_url_para_pagina($pagina);
    $this->assertUrlRegExp($url_regexp);
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
   * Registra un usuario en la aplicación.
   *
   * @param  string $email
   * @param  string $contrasena
   * @param  string $rol
   * @return TourGuide\Models\Usuario;
   */
  private function registrar_usuario($email, $contrasena, $rol) {
    $rol_id = constant('ROL_'.strtoupper($rol));
    return Usuario::create([
      'email'      => $email,
      'contrasena' => $contrasena,
      'nombre'     => 'Usuario',
      'apellido'   => 'de pruebas',
      'idioma'     => 'es',
      'rol_id'     => $rol_id,
    ]);
  }

  /**
   * Devuelve una expresión regular para la url de la página especificada.
   *
   * @param  string $pagina
   * @return regexp
   */
  private function obtener_url_para_pagina($pagina) {
    $paginas = [
      'dashboard'            => "/^\/dashboard$/",
      'iniciar sesión'       => "/^\/sesiones\/entrar$/",
      'obtener el app móvil' => "/^\/obtener-app$/",
      'administrar usuarios' => "/^\/usuarios/",
    ];

    return $paginas[$pagina];
  }

}
