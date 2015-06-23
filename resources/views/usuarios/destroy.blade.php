<!DOCTYPE html>
<html>
<head>
  <title>Eliminar usuario - Tourguide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <h3>Usuario eliminado</h3>

    <p>El usuario "{{ $usuario->email }}" ha sido eliminado.</p>

    <p>
      {!! link_to_route('usuarios.index', 'Volver a lista de usuarios') !!}
    </p>
  </div>
</body>
</html>
