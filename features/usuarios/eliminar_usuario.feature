# language: es
Característica: Eliminar nuevo usuario

  Antecedentes:
    Dado que juliolarumbe@example.com está registrado con contraseña "julio" como administrador
    Y que admin@tourguide.com inicia sesión con contraseña "admin"
    Y que visita la página para administrar usuarios

  @javascript
  Escenario: Eliminando un usuario
    Cuando elimina a juliolarumbe@example.com
    Entonces debería haber 1 administrador guardado
    Y debería haber 0 turistas guardados
