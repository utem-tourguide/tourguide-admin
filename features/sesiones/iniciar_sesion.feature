#language: es
Característica: Iniciar sesión
  Como un administrador de TourGuide
  Quiero iniciar sesión
  Para poder comenzar a usar la aplicación

  Escenario: admin@tourguide.com inicia sesión
    Dado que visito "/sesiones/entrar"
    Cuando escribo "admin@tourguide.com" en el campo "email"
    Y escribo "admin" en el campo "contrasena"
    Y hago clic en "Entrar"
    Entonces debería estar en /^\/dashboard$/

  Escenario: no-registrado@tourguide.com inicia sesión
    Dado que visito "/sesiones/entrar"
    Cuando escribo "no-registrado@tourguide.com" en el campo "email"
    Y escribo "no-registrado" en el campo "contrasena"
    Y hago clic en "Entrar"
    Entonces debería estar en /^\/sesiones\/entrar$/
    Y debería ver "Usuario o contraseña incorrectos"

