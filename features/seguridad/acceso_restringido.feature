#language: es
Característica: Acceso restringido

  @auth
  Escenario: Invitado trata de administrar usuarios
    Dado que no hay sesión iniciada
    Cuando visita la página para administrar usuarios
    Entonces debería estar en la página para iniciar sesión

  @auth
  Escenario: Turista trata de administrar ubicaciones
    Dado que turista@tourguide.com se registra como turista con contraseña "turista" y accede
    Cuando visita la página para administrar ubicaciones
    Entonces debería estar en la página para obtener el app móvil
