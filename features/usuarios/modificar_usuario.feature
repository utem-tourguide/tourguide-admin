# language: es
Característica: Modificar un usuario

  Antecedentes:
    Dado que juliolarumbe@example.com está registrado con contraseña "julio" como administrador
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar usuarios

  @javascript
  Escenario: Modificando el rol de un usuario
    Dado que comienza a editar los datos de juliolarumbe@example.com
    Cuando selecciona Turista en rol_id
    Y hace clic en "Guardar"
    Entonces debería haber 1 administrador guardado
    Y debería haber 1 turista guardado
