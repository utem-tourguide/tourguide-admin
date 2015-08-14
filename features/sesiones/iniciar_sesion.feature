#language: es
Característica: Iniciar sesión
  Como un administrador de TourGuide
  Quiero iniciar sesión
  Para poder comenzar a usar la aplicación

  Escenario: admin@tourguide.com inicia sesión
    Dado que admin@tourguide.com inicia sesión con contraseña "admin"
    Entonces debería estar en la página del dashboard

  Escenario: no-registrado@tourguide.com inicia sesión
    Dado que no@registrado.com inicia sesión con contraseña "contraseña"
    Entonces debería estar en la página para iniciar sesión
    Y debería ver "Usuario o contraseña incorrectos"

  Escenario: turista@tourguide.com inicia sesión
    Dado que turista@tourguide.com se registra como turista con contraseña "turista" y accede
    Entonces debería estar en la página para obtener el app móvil
