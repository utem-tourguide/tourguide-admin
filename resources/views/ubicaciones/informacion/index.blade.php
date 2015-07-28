<html>
<head>
  <title>Administrar información de ubicaciones - TourGuide</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <h3>Administrar información para {{ $ubicacion->nombre }}</h3>

    <p>
      En esta página puedes administrar la información almacenada sobre la ubicación
      turística "{{ $ubicacion->nombre }}". Para añadir información en nuevo idioma,
      haz clic en <strong>Nuevo</strong>. Para modificar o eliminar alguna entrada de
      información, haz clic en el botón <strong>Modificar</strong> o
      <strong>Eliminar</strong> que corresponda.
    </p>

    <div class="well">
      <button id="nuevaInformacion" class="btn btn-primary">Nueva entrada</button>
    </div>

    <div class="table-responsive">
      <table id="informacion" class="table table-striped table-condensed">
        <tr>
          <th>ID</th>
          <th>Información</th>
          <th>Idioma</th>
          <th>Acciones</th>
        </tr>
      </table>
    </div>
  </div>

  <script src="/js/app.js"></script>
  <script src="/js/crud.js"></script>
  <script>
   crud = new CRUDRecurso('informacion',
                          '{{ route('ubicaciones.informacion.index', [$ubicacion->id]) }}',
                          $('#informacion'),
                          ['id', 'contenido', 'idioma']);
   crud.cargarTabla();
   $('#nuevaInformacion').on('click', function() { crud.mostrarNuevo() });
 </script>
</body>
</html>
