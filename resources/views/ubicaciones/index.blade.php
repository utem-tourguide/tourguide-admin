<!DOCTYPE html>
<html>
<head>
  <title>Ubicaciones turísticas - TourGuide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <h1>Ubicaciones turísticas</h1>

    <div class="well well-sm">
      <button id="nuevaUbicacion" class="btn btn-primary">Nueva ubicación</button>
    </div>

    <table id="ubicaciones" class="table table-striped table-bordered" hidden>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Localización</th>
        <th>Creada en</th>
        <th>Modificada en</th>
        <th>Acciones</th>
      </tr>
    </table>

  </div>

  <script src="/js/app.js"></script>
  <script src="/js/crud.js"></script>
  <script>
  crud = new CRUDRecurso('ubicación turística',
                          '{{ route('ubicaciones.index') }}',
                          $('#ubicaciones'),
                          ['id', 'nombre', 'localizacion', 'created_at', 'updated_at']);
   crud.cargarTabla();
   $('#nuevaUbicacion').on('click', function() { crud.mostrarDialogoNuevo() });
  </script>
</body>
</html>
