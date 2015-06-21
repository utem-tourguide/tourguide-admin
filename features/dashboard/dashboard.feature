# language: es
Característica: Dashboard
  Como un administrador de TourGuide
  Quiero tener acceso al Dashboard
  Para revisar rápidamente lo que necesito saber del estado de TourGuide

  Escenario: Accediendo al dashboard
    Dado que accedo como administrador
    Cuando visito "/dashboard"
    Entonces debería ver "Bienvenido, Administador de TourGuide"
