<?php

/**
 * Este archivo define algunas reglas personalizadas para convertir
 * palabras de singular a plural y viceversa.
 */

use Doctrine\Common\Inflector\Inflector;

Inflector::rules('singular', [
  'irregular' => ['administradores' => 'administrador',
                  'turistas'        => 'turista'],
  'uninflected' => ['turista'],
], true);

Inflector::rules('plural', [
  'irregular' => ['administrador' => 'administradores',
                  'turista'       => 'turistas'],
], true);
