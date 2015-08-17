# language: es
Característica: Crear nueva información de ubicación

  Antecedentes:
    Dado que está registrada la ubicación La Campana en Colima, Colima
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar la información de La Campana

  @javascript
  Escenario: Creando información en español y en inglés para La Campana
    Cuando registra "Es una zona arqueológica" como información de La Campana en español
    Cuando registra "It is an archeological zone" como información de La Campana en inglés
    Entonces debería haber 1 una entrada de información para La Campana en español
    Entonces debería haber 1 una entrada de información para La Campana en inglés
