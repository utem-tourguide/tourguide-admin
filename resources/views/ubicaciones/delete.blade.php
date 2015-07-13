<html>
<head>
  <title>Eliminar ubicacion - Tourguide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <h3>Ubicacion eliminada</h3>

    <p>La ubicacion "{{  $ubicaciones->nombre }}" ha sido eliminada.</p>

    <p>
      {!! link_to_route('ubicaciones.index', 'Volver a lista de ubicaciones') !!}
    </p>
  </div>
</body>
</htmls