# language: es
Característica: Modificar información de ubicación

  Antecedentes:
    Dado que está registrada la ubicación La Campana en Colima, Colima
    Y que hay información en español para La Campana
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar la información de La Campana

  @javascript
  Escenario: Modificando información de La Campana
    Cuando que comienza a editar la información en español de La Campana
    Y escribe "Es una zona arqueológica" en el campo "Contenido"
    Y hace clic en "Guardar"
    Entonces la información en español de La Campana debería ser "Es una zona arqueológica"
