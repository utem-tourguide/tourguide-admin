<!DOCTYPE html>
<html>
<head>
  <title>Ubicaciones turísticas - TourGuide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body onload="cargarTablaUbicaciones('{{ route('ubicaciones.index') }}')">
  <div class="container-fluid">
    <h1>Ubicaciones turísticas</h1>

    @if (Session::has('mensaje'))
      <div class="alert alert-info">
        <p>{{ Session::get('mensaje') }}</p>
      </div>
    @endif

    <div class="well well-sm">
      <button class="btn btn-primary" data-toggle="modal" data-target="#ubicacionNuevo">
        Nuevo
      </button>
      <button class="btn btn-default" onclick="cargarTablaUbicaciones('{{ route('ubicaciones.index') }}')">
        Recargar
      </button>
    </div>

    <table id="tabla" class="table table-striped table-bordered" hidden>
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

  @include('ubicaciones.partials.dialogo_nuevo')
  @include('ubicaciones.partials.dialogo_edit')
  

  <script type="text/javascript" src="/js/app.js"></script>
  <script type="text/javascript" src="/js/ubicaciones.js"></script>
</body>
</html>
