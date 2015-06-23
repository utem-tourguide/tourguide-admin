<?php

/**
 * Este archivo define algunas reglas personalizadas para convertir
 * palabras de singular a plural y viceversa.
 */

use Doctrine\Common\Inflector\Inflector;

Inflector::rules('plural', [
  'irregular' => ['administrador' => 'administradores'],
  'irregular' => ['turista'       => 'turistas'],
], true);

Inflector::rules('singular', [
  'irregular' => ['turista' => 'turista'],
], true);
