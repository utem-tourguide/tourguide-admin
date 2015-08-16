<?php

use Behat\Mink\Element\Element;
use Behat\Mink\Exception\ElementNotFoundException;
use Behat\MinkExtension\Context\MinkContext;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit_Framework_Assert as PHPUnit;
use TourGuide\Models\Postal;
use TourGuide\Models\UbicacionTuristica;
use TourGuide\Models\Usuario;

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
   *
   * @param string $url
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
   * Registra un usuario en la aplicación.
   *
   * @param  string $email
   * @param  string $contrasena
   * @param  string $rol
   * @return TourGuide\Models\Usuario;
   *
   * @Given /^que (.*) está registrado con contraseña "(.*)" como (.*)$/
   */
  public function registrar_usuario($email, $contrasena, $rol) {
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
   * @Given /^que está registrada la ubicación (.*) en (.*)$/
   *
   * @param string $ubicacion
   * @param string $localizacion
   */
  public function registrar_ubicacion($ubicacion, $localizacion) {
    UbicacionTuristica::create(['nombre'       => $ubicacion,
                                'localizacion' => $localizacion]);
  }

  /**
   * @When /^escribe "(.*)" en el campo "(.*)"$/
   */
  public function escribir_en_campo($valor, $campo) {
    $pagina = $this->getSession()->getPage();
    $pagina->fillField($campo, $valor);
  }

  /**
   * @When /^selecciona (.*) en (.*)$/
   */
  public function seleccionar_en_campo($valor, $campo) {
    $pagina = $this->getSession()->getPage();
    $pagina->selectFieldOption($campo, $valor);
  }

  /**
   * @When /^hace clic en "(.*)"$/
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
   * @When /^registra la ubicación "(.*)" en (.*)$/
   *
   * @param string $ubicacion
   * @param string $localizacion
   */
  public function registrar_ubicacion_via_formulario($ubicacion, $localizacion) {
    $this->hacer_clic('Nueva ubicación');
    sleep(1);

    $this->escribir_en_campo($ubicacion, 'nombre');
    $this->escribir_en_campo($localizacion, 'localizacion');

    $this->hacer_clic('Guardar');
    sleep(1);
  }

  /**
   * @When /^registra una postal$/
   */
  public function registrar_postal_via_formulario() {
    $this->hacer_clic('Nueva postal');
    sleep(1);

    $this->escribir_en_campo('0.99', 'precio');
    $this->hacer_clic('Guardar');
    sleep(1);
  }

  /**
   * @When /^que hay una postal para (.+) con precio \$([0-9]+.?[0-9]*)$/
   *
   * @param string $ubicacion
   * @param int    $precio
   */
  public function registrar_postal($ubicacion, $precio) {
    $ubicacion = $this->encontrar_ubicacion($ubicacion);
    Postal::create(['precio'       => $precio,
                    'ubicacion_id' => $ubicacion->id]);
  }

  /**
   * @When /^elimina a (.*)$/
   *
   * @param $email
   *
   * @throws ElementNotFoundException
   */
  public function eliminar_usuario($email) {
    $this->eliminar_recurso(Usuario::whereEmail($email)->first());
  }

  /**
   * @When /^elimina la ubicación (.*)$/
   *
   * @param string $ubicacion
   */
  public function eliminar_ubicacion($ubicacion) {
    $this->eliminar_recurso($this->encontrar_ubicacion($ubicacion));
  }

  /**
   * @When /^elimina la postal #([0-9]+)$/
   *
   * @param string $postal_id
   */
  public function eliminar_postal($postal_id) {
    $this->eliminar_recurso(Postal::findOrFail($postal_id));
  }

  /**
   * @When /^(?:que )?comienza a editar los datos de (.*)$/
   *
   * @param string $email
   */
  public function comenzar_edicion_datos_de_usuario($email) {
    $this->comenzar_edicion_de_recurso(Usuario::whereEmail($email)->first());
  }

  /**
   * @When /^(?:que )?comienza a editar la ubicación (.*)$/
   *
   * @param string $ubicacion
   */
  public function comenzar_edicion_de_ubicacion($ubicacion) {
    $this->comenzar_edicion_de_recurso($this->encontrar_ubicacion($ubicacion));
  }

  /**
   * @When /^que comienza a editar la postal \#(\d+)$/
   */
  public function comenzar_edicion_de_postal($postal) {
    $recurso = new stdClass();
    $recurso->id = $postal;
    $this->comenzar_edicion_de_recurso($recurso);
  }

  /**
   * @When /^espera (\d+) segundos?$/
   */
  public function esperar_segundos($segundos) {
    sleep($segundos);
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
   * @Then /^debería haber ([0-9]+) postal(?:es)? guardadas? para (.+)?$/
   *
   * @param string $cantidad
   * @param string $ubicacion
   */
  public function verificar_postales_guardadas($cantidad, $ubicacion) {
    $ubicacion = $this->encontrar_ubicacion($ubicacion);

    PHPUnit::assertEquals($cantidad, $ubicacion->postales()->count());
  }

  /**
   * @Then /^(?:el|la) (.*) de la ubicación (.*) debería ser (.*)$/
   *
   * @param string $atributo
   * @param string $ubicacion
   * @param string $valor
   */
  public function verificar_atributo_de_ubicacion($atributo, $ubicacion, $valor) {
    $ubicacion = $this->encontrar_ubicacion($ubicacion);
    $this->verificar_atributo_de_recurso($atributo, $valor, $ubicacion);
  }

  /**
   * @Then /^(?:el|la) (.*) de la postal \#(\d+) de (.*) debería ser "(.*)"$/
   *
   * @param string $atributo
   * @param string $postal_id
   * @param string $ubicacion_nombre
   * @param string $valor
   *
   * @internal param Postal $postal
   * @internal param UbicacionTuristica $ubicacion
   */
  public function verificar_atributo_de_postal($atributo, $postal_id, $ubicacion_nombre, $valor) {
    $postal = $this->encontrar_ubicacion($ubicacion_nombre)->postales()->findOrFail($postal_id);
    $this->verificar_atributo_de_recurso($atributo, $valor, $postal);
  }

  /**
   * @Then /^debería haber (\d+) ubicaci(?:ón|ones) guardadas?$/
   *
   * @param int $cantidad
   */
  public function verificar_ubicaciones_guardadas($cantidad) {
    PHPUnit::assertEquals($cantidad, UbicacionTuristica::count());
  }

  /**
   * Encuentra un elemento cliqueable en la página. Lanza una excepción si el
   * el elemento no es encontrado.
   *
   * @param  string $locator
   * @return Element
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
   * Devuelve una expresión regular para la url de la página especificada.
   *
   * @param  string $pagina
   * @return regexp
   */
  private function obtener_url_para_pagina($pagina) {
    $paginas = [
      'dashboard'                          => route('dashboard'),
      'iniciar sesión'                     => route('login'),
      'obtener el app móvil'               => route('obtener_app'),
      'administrar usuarios'               => route('administrar.usuarios'),
      'administrar ubicaciones'            => route('administrar.ubicaciones'),
    ];

    return isset($paginas[$pagina]) ? $paginas[$pagina] : $this->obtener_url_dinamica($pagina);
  }

  /**
   * @param string $pagina
   *
   * @return string
   */
  private function obtener_url_dinamica($pagina) {
    $coincidencias = [];
    switch (true) {
      case preg_match("/^administrar postales de (.*)$/", $pagina, $coincidencias):
        return route('administrar.ubicaciones.postales', [
          $this->encontrar_ubicacion($coincidencias[1])->id
        ]);
    }
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

  /**
   * @param Model $recurso
   */
  private function comenzar_edicion_de_recurso($recurso) {
    sleep(1);
    $fila = $this->obtener_fila_de_tabla_para_recurso($recurso);
    $fila->findButton('Modificar')->click();
    sleep(1);
  }

  /**
   * @param Model $recurso
   *
   * @return \Behat\Mink\Element\NodeElement|mixed|null
   */
  private function obtener_fila_de_tabla_para_recurso($recurso) {
    $pagina = $this->getSession()->getPage();
    $fila = $pagina->find('css', "tr[data-id=$recurso->id]");
    if ( ! $fila) throw new RuntimeException("El recurso específicado no está en la página.");

    return $fila;
  }

  /**
   * @param Model $recurso
   */
  private function eliminar_recurso($recurso) {
    sleep(1);
    $fila = $this->obtener_fila_de_tabla_para_recurso($recurso);
    $fila->findButton('Eliminar')->click();
    sleep(1);
    $this->getSession()->getPage()->find('css', '.modal-footer .btn-danger')->click();
    sleep(1);
  }

  private function verificar_atributo_de_recurso($atributo, $valor, $recurso) {
    PHPUnit::assertEquals($valor, $recurso->{str_slug($atributo, '_')});
  }

  private function encontrar_ubicacion($nombre) {
    $ubicacion = UbicacionTuristica::whereNombre($nombre)->first();
    if ( ! $ubicacion) throw new ModelNotFoundException("Ubicación \"$nombre\" no encontrada.");

    return $ubicacion;
  }

}
