# language: es
Característica: Crear nuevo usuario

  Antecedentes:
    Dado que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar usuarios

  @javascript
  Escenario: Creando un administrador
    Cuando registra a juliolarumbe@tourguide.com con contraseña "julio" como administrador
    Entonces debería haber 2 administradores guardados
    Y debería haber 0 turistas guardados

  @javascript
  Escenario: Creando un turista
    Cuando registra a edgarlarios@turista.com con contraseña "edgar" como turista
    Entonces debería haber 1 turista guardado
    Y debería haber 1 administrador guardado

  @javascript @validation
  Escenario: Creando un turista sin rellenar todos los campos
    Cuando hace clic en "Nuevo usuario"
    Y espera 1 segundo
    Y hace clic en "Guardar"
    Entonces debería haber 0 turistas guardados
    Y debería haber 1 administrador guardado
    Y debería ver "El campo email es obligatorio"
