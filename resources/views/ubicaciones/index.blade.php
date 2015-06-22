<!DOCTYPE html>
<html>
<head>
  <title>Ubicaciones turísticas - TourGuide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <h1>Ubicaciones turísticas</h1>

    <table class="table table-striped table-bordered">
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Localización</th>
        <th>Creada en</th>
        <th>Modificada en</th>
      </tr>
      @foreach ($ubicaciones as $ubicacion)
        <tr>
          <td>{{ $ubicacion->id }}</td>
          <td>{{ $ubicacion->nombre }}</td>
          <td>{{ $ubicacion->localizacion }}</td>
          <td>{{ $ubicacion->created_at }}</td>
          <td>{{ $ubicacion->updated_at }}</td>
        </tr>
      @endforeach
    </table>
  </div>
</body>
</html>
