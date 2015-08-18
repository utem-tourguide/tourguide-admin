# language: es
Característica: Crear nueva ubicación

  Antecedentes:
    Dado que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar ubicaciones

  @javascript
  Escenario: Creando una ubicación
    Cuando registra la ubicación "La campana" en Colima, Colima
    Entonces debería haber 1 ubicación guardada

  @javascript @validation
  Escenario: Creando una ubicación sin rellenar todos los campos
    Cuando hace clic en "Nueva ubicación"
    Y espera 1 segundo
    Y hace clic en "Guardar"
    Entonces debería haber 0 ubicaciones guardadas
    Y debería ver "El campo nombre es obligatorio"
