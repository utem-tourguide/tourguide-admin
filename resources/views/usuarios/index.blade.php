<!DOCTYPE html>
<html>
<head>
  <title>Usuarios - TourGuide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body onload="cargarTablaUsuarios('{{ route('usuarios.index') }}')">
  <div class="container-fluid">
    <h1>Usuarios</h1>
    
    @if (Session::has('mensaje'))
      <div class="alert alert-info">
        <p>{{ Session::get('mensaje') }}</p>
      </div>
    @endif

    <div class="well well-sm">
      <button class="btn btn-primary" data-toggle="modal" data-target="#usuarioNuevo">
        Nuevo
      </button>
      <button class="btn btn-default" onclick="cargarTablaUsuarios('{{ route('usuarios.index') }}')">
        Recargar
      </button>
    </div>
    
    <table id="tabla" class="table table-striped table-bordered" hidden>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>idioma</th>
        <th>Email</th>
        <th>Id de rol</th>
        <th>Acciones</th>
      </tr>
    </table>

     @include('usuarios.partials.dialogo_nuevo')

  <script type="text/javascript" src="/js/app.js"></script>
  <script type="text/javascript" src="/js/usuarios.js"></script>

  </div>
</body>
</html>
