<!DOCTYPE html>
<html>
<head>
  <title>Usuarios - TourGuide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <h1>Usuarios</h1>
    
    @if (Session::has('mensaje'))
      <div class="alert alert-info">
        <p>{{ Session::get('mensaje') }}</p>
      </div>
    @endif

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
        <th>Acciones</th>
      </tr>
      @foreach ($usuarios as $usuario)
        <tr>
          <td>{{ $usuario->id }}</td>
          <td>{{ $usuario->email }}</td>
          <td>{{ $usuario->nombre }}</td>
          <td>{{ $usuario->apellido }}</td>
          <td>{{ $usuario->idioma }}</td>
          <td>{{ $usuario->rol_id }}</td>
          <td>
              <a class="btn btn-primary btn-sm" href="{{ route('usuarios.edit', [$usuario->id]) }}">Editar</a>

              {!! Form::open(['route' => ['usuarios.destroy', $usuario->id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) !!}
                <button class="btn btn-danger btn-sm">Eliminar</button>
              {!! Form::close() !!}
          </td>
        </tr>
      @endforeach
    </table>
    {!! $usuarios->render() !!}
  </div>
</body>
</html>