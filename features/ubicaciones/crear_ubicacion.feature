# language: es
Característica: Crear nueva ubicación

  Antecedentes:
    Dado que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar ubicaciones

  @javascript
  Escenario: Creando una ubicación
    Cuando registra la ubicación "La campana" en Colima, Colima
    Entonces debería haber 1 ubicación guardada
