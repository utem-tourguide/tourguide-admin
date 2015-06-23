# language: es
Característica: Crear nuevo usuario

  Antecedentes:
    Dado que admin@tourguide.com inicia sesión
    Y que visita la página para administrar usuarios

  Escenario: Creando un administrador
    Cuando registra a juliolarumbe@tourguide.com como administrador
    Entonces debería haber 2 administradores guardados
    Y debería haber 0 turistas guardados

  Escenario: Creando un turista
    Cuando registra a edgarlarios@turista.com como turista
    Entonces debería haber 1 turista guardado
    Y debería haber 1 administrador guardado
