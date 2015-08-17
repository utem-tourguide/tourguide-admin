# language: es
Característica: Crear nueva postal

  Antecedentes:
    Dado que está registrada la ubicación La Campana en Colima, Colima
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar postales de La Campana

  @javascript
  Escenario: Creando una postal
    Cuando registra una postal
    Entonces debería haber 1 postal guardada para La Campana
