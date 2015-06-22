<!DOCTYPE html>
<html>
<head>
  <title>Usuarios - TourGuide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <h1>Usuarios</h1>
    <div class="well well-sm">
      {!! link_to_route('usuarios.create', 'Nuevo', [], ['class' => "btn btn-primary"]) !!}
    </div>
    <table class="table table-striped table-bordered">
      <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Idioma</th>
        <th>Id de rol</th>
      </tr>
      @foreach ($usuarios as $usuario)
        <tr>
          <td>{{ $usuario->id }}</td>
          <td>{{ $usuario->email }}</td>
          <td>{{ $usuario->nombre }}</td>
          <td>{{ $usuario->apellido }}</td>
          <td>{{ $usuario->idioma }}</td>
          <td>{{ $usuario->rol_id }}</td>
        </tr>
      @endforeach
    </table>
    {!! $usuarios->render() !!}
  </div>
</body>
</html>
