<!DOCTYPE html>
<html>
<head>
  <title>Usuarios - TourGuide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <h1>Administrar usuarios</h1>

    <div class="well well-sm">
      <button id="nuevoUsuario" class="btn btn-primary">Nuevo usuario</button>
    </div>

    <table id="usuarios" class="table table-striped table-bordered" hidden>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Idioma</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Creado en</th>
        <th>Modificado en</th>
        <th>Acciones</th>
      </tr>
    </table>

  <script type="text/javascript" src="/js/app.js"></script>
  <script type="text/javascript" src="/js/crud.js"></script>
  <script>
    var atributos = ['id',
                     'nombre',
                     'apellido',
                     'idioma',
                     'email',
                     'rol',
                     'created_at',
                     'updated_at'];
    var crud = new CRUDRecurso('usuario',
                               '{{ route('usuarios.index') }}',
                               $('#usuarios'),
                               atributos);

    crud.cargarTabla();

    $('#nuevoUsuario').on('click', function() { crud.mostrarDialogoNuevo() });
  </script>
  </div>
</body>
</html>
