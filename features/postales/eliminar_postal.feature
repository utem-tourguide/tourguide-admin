# language: es
Característica: Eliminar postal

  Antecedentes:
    Dado que está registrada la ubicación La Campana en Colima, Colima
    Y que hay una postal para La Campana con precio $0.99
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar postales de La Campana

  @javascript
  Escenario: Eliminando ubicación La Campana
    Cuando elimina la postal #1
    Entonces debería haber 0 postales guardadas para La Campana
