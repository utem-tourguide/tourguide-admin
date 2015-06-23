<?php

use TourGuide\Models\Usuario;
use PHPUnit_Framework_Assert as PHPUnit;
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
    $regexp = $this->obtener_url_para_pagina($pagina);
    $this->visitar_url($this->convertir_regexp_a_url($regexp));
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
   * @When /^selecciono (\S)+ en (\S)+$/
   */
  public function seleccionar_en_campo($valor, $campo) {
    $pagina = $this->getSession()->getPage();
    $pagina->selectFieldOption($campo, $valor);
  }

  /**
   * @When /^hago clic en "(.*)"$/
   */
  public function hacer_clic($locator) {
    $elemento = $this->encontrar_cliqueable($locator);
    $elemento->click();
  }

  /**
   * @When /^registra a (\S+) como (\S+)$/
   */
  public function registrar_usuario_via_formulario($email, $rol) {
    $this->verificar_pagina('administrar usuarios');

    $this->visitar_url(route( 'usuarios.create' ));
    $this->escribir_en_campo($email, 'email');
    $this->escribir_en_campo('admin', 'contrasena');
    $this->escribir_en_campo('admin', 'confirmar_contrasena');
    $this->escribir_en_campo('Usuario', 'nombre');
    $this->escribir_en_campo('de prueba', 'apellido');
    $this->seleccionar_en_campo('Español', 'idioma');
    $this->seleccionar_en_campo($this->obtener_rol_id($rol), 'rol_id');

    $this->hacer_clic('Guardar');
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
   * @Then /^debería haber (\d)+ (\S)+ guardados?$/
   */
  public function verificar_usuarios_guardados($cantidad, $rol) {
    /*$rol_id = $this->obtener_rol_id($rol);

    PHPUnit::assertEquals($cantidad, Usuario::whereRolId($rol_id)->count());*/
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
    return Usuario::create([
      'email'      => $email,
      'contrasena' => $contrasena,
      'nombre'     => 'Usuario',
      'apellido'   => 'de pruebas',
      'idioma'     => 'es',
      'rol_id'     => $this->obtener_rol_id($rol),
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

  /**
   * Convierte una regexp que representa una url en una simple cadena de texto.
   *
   * @param  regexp $regexp
   * @return string
   */
  private function convertir_regexp_a_url($regexp) {
    return preg_replace("/\^|\\\|\$/", '', trim($regexp, '/'));
  }

  /**
   * Devuelve el rol id de un rol especificado.
   *
   * @param  string $rol
   * @return int
   */
  private function obtener_rol_id($rol) {
    return constant('ROL_' . strtoupper( str_singular($rol)));
  }

}
