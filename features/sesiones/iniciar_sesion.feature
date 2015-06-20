#language: es
Característica: Iniciar sesión
  Como un administrador de TourGuide
  Quiero iniciar sesión
  Para poder comenzar a usar la aplicación

  Escenario: kevindperezm@tourguide.com inicia sesión
    Dado que visito "/sesiones/entrar"
    Cuando escribo "kevindperezm@tourguide.com" en el campo "email"
    Y escribo "asdfg" en el campo "contrasena"
    Y hago clic en "Entrar"
    Entonces debería estar en /^dashboard$/
