# language: es
Característica: Modificar ubicación

  Antecedentes:
    Dado que está registrada la ubicación La Campana en Manzanillo, Colima
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar ubicaciones

  @javascript
  Escenario: Modificando localización de La Campana
    Cuando comienza a editar la ubicación La Campana
    Y escribe "Colima, Colima" en el campo "Localización"
    Y hace clic en "Guardar"
    Entonces la localización de la ubicación La Campana debería ser Colima, Colima
