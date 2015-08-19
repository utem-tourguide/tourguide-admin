# language: es
Característica: Eliminar entrada de información

  Antecedentes:
    Dado que está registrada la ubicación La Campana en Colima, Colima
    Y que hay información en español para La Campana
    Y que hay información en inglés para La Campana
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar la información de La Campana

  @javascript
  Escenario: Eliminando entrada de información de La Campana
    Cuando elimina la información en español de La Campana
    Entonces debería haber 1 entrada de información para La Campana en inglés
    Y debería haber 0 entradas de información para La Campana en español
