# language: es
Característica: Eliminar ubicación

  Antecedentes:
    Dado que está registrada la ubicación La Campana en Colima, Colima
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar ubicaciones

  @javascript
  Escenario: Eliminando ubicación La Campana
    Cuando elimina la ubicación La Campana
    Entonces debería haber 0 ubicaciones guardadas
