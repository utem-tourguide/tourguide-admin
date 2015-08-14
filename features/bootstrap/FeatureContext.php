<?php

use TourGuide\Models\Usuario;
use PHPUnit_Framework_Assert as PHPUnit;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Mink\Exception\ElementNotFoundException;

class FeatureContext extends MinkContext {

  /**
   * @AfterSuite
   */
  public static function eliminar_bd() {
    $bd = base_path('acceptance.sqlite');

    if (file_exists($bd)) unlink($bd);
  }

  /**
   * Reinicializa la base de datos para pruebas de integración a partir de una copia base de la
   * misma.
   *
   * @BeforeScenario
   */
  public function reinicializar_bd() {
    $origen  = base_path('.db_base.sqlite');
    $destino = base_path('acceptance.sqlite');

    if (file_exists($destino)) unlink($destino);
    copy($origen, $destino);
  }

  /**
   * @AfterStep @javascript
   */
  public function esperar_ajax() {
    $this->getSession()->wait(5000, '(0 === jQuery.active)');
  }

  /**
   * @Given /^(?:que )?visita la página (?:para|de) (.*)$/
   */
  public function visitar_pagina($pagina) {
    $this->visitar_url($this->obtener_url_para_pagina($pagina));
  }

  /**
   * @Given /^(?:que )?visita "(\S+)"$/
   */
  public function visitar_url($url) {
    $this->getSession()->visit($url);
  }

  /**
   * @Given /^(?:que )?(.*) se registra como (.*) con contraseña "(.*)" y accede$/
   */
  public function registrar_y_acceder($email, $contraseña, $rol) {
    $this->registrar_usuario($email, $contraseña, $rol);
    $this->iniciar_sesion($email, $contraseña);
  }

  /**
   * @Given /^(?:que )?(.*) inicia sesión con contraseña "(.*)"$/
   */
  public function iniciar_sesion($email, $contraseña) {
    $this->visitar_url(route( 'login' ));
    $this->escribir_en_campo($email, 'email');
    $this->escribir_en_campo($contraseña, 'contrasena');
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
   * @When /^registra a (\S+) con contraseña "(\S+)" como (\S+)$/
   */
  public function registrar_usuario_via_formulario($email, $contraseña, $rol) {
    $this->hacer_clic('Nuevo usuario');
    sleep(1);

    $this->escribir_en_campo($email, 'email');
    $this->escribir_en_campo($contraseña, 'contrasena');
    $this->escribir_en_campo($contraseña, 'contrasena_confirmation');
    $this->escribir_en_campo('Usuario', 'nombre');
    $this->escribir_en_campo('de prueba', 'apellido');
    $this->seleccionar_en_campo('Español', 'idioma');
    $this->seleccionar_en_campo($this->obtener_rol_id($rol), 'rol_id');

    $this->hacer_clic('Guardar');
    sleep(1);
  }

  /**
   * @Then /^debería estar en la página (?:para|del) (.*)$/
   */
  public function verificar_pagina($pagina) {
    $current_url = $this->getSession()->getCurrentUrl();
    PHPUnit::assertEquals($this->obtener_url_para_pagina($pagina), $current_url);
  }

  /**
   * @Then /^debería ver "(.*)"$/
   */
  public function verificar_texto_en_pagina($texto) {
    $this->assertPageContainsText($texto);
  }

  /**
   * @Then /^debería haber (\d+) (\S*) guardados?$/
   */
  public function verificar_usuarios_guardados($cantidad, $rol) {
    $rol_id = $this->obtener_rol_id($rol);

    PHPUnit::assertEquals($cantidad, Usuario::whereRolId($rol_id)->count());
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
    $usuario = new Usuario([
      'email'      => $email,
      'contrasena' => $contrasena,
      'nombre'     => 'Usuario',
      'apellido'   => 'de pruebas',
      'idioma'     => 'es',
    ]);
    $usuario->rol_id = $this->obtener_rol_id($rol);
    $usuario->save();
  }

  /**
   * Devuelve una expresión regular para la url de la página especificada.
   *
   * @param  string $pagina
   * @return regexp
   */
  private function obtener_url_para_pagina($pagina) {
    $paginas = [
      'dashboard'            => route('dashboard'),
      'iniciar sesión'       => route('login'),
      'obtener el app móvil' => route('obtener_app'),
      'administrar usuarios' => route('administrar.usuarios'),
    ];

    return $paginas[$pagina];
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
