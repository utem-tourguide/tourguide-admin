# language: es
Característica: Modificar ubicación

  Antecedentes:
    Dado que está registrada la ubicación La campana en Manzanillo, Colima
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar ubicaciones

  @javascript
  Escenario: Modificando localización de La campana
    Cuando que comienza a editar la ubicación La campana
    Y escribe "Colima, Colima" en el campo "Localización"
    Y hace clic en "Guardar"
    Entonces la localización de la La campana debería ser "Manzanillo, Colima"
