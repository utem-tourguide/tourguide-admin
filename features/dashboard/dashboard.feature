# language: es
Característica: Dashboard
  Como un administrador de TourGuide
  Quiero tener acceso al Dashboard
  Para revisar rápidamente lo que necesito saber del estado de TourGuide

  Escenario: Accediendo al dashboard
    Dado que admin@tourguide.com inicia sesión
    Cuando visita "/dashboard"
    Entonces debería ver "Bienvenido, Administador de TourGuide"
