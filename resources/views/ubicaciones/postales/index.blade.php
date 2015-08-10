<html>
<head>
  <title>Administrar postales - TourGuide</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <h3>Administrar postales para {{ $ubicacion->nombre }}</h3>

    <p>
      En esta página puedes administrar las postales almacenadas sobre la ubicación turística "{{ $ubicacion->nombre }}". Para añadir una postal, haz clic en <strong>Nueva postal</strong>. Para modificar o eliminar alguna postal, haz clic en el botón <strong>Modificar</strong> o <strong>Eliminar</strong> que corresponda.
    </p>

    <div class="well">
      <button id="nuevaPostal" class="btn btn-primary">Nueva postal</button>
    </div>

    <div class="table-responsive">
      <table id="postales" class="table table-striped table-condensed">
        <tr>
          <th>ID</th>
          <th>Imagen</th>
          <th>Acciones</th>
        </tr>
      </table>
    </div>
  </div>

  <script src="/js/app.js"></script>
  <script src="/js/crud.js"></script>
  <script>
   crud = new CRUDRecurso('postales',
                          '{{ route('ubicaciones.postales.index', [$ubicacion->id]) }}',
                          $('#postales'),
                          ['id']);
   crud.cargarTabla();
   $('#nuevaPostal').on('click', function() { crud.mostrarDialogoNuevo() });
 </script>
</body>
</html>
