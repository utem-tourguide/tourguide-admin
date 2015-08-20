# language: es
Característica: Crear nueva postal

  Antecedentes:
    Dado que está registrada la ubicación La Campana en Colima, Colima
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar postales de La Campana

  @javascript @images
  Escenario: Creando una postal
    Cuando registra una postal
    Entonces debería haber 1 postal guardada para La Campana

  @javascript @validation
  Escenario: Creando una postal sin rellenar todos los campos
    Cuando hace clic en "Nueva postal"
    Y espera 1 segundo
    Y hace clic en "Guardar"
    Entonces debería haber 0 postales guardadas para La Campana
    Y debería ver "El campo precio es obligatorio"

  @javascript @validation @images
  Escenario: Creando una postal sin imagen
    Dado que hace clic en "Nueva postal"
    Y espera 1 segundo
    Cuando escribe "0.99" en el campo "Precio"
    Y hace clic en "Guardar"
    Entonces debería haber 0 postales guardadas para La Campana
    Y debería ver "El campo imagen es obligatorio"
