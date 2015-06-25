<!DOCTYPE html>
<html>
<head>
  <title>Ubicaciones turísticas - TourGuide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
  <div class="container-fluid">
    <h1>Ubicaciones turísticas</h1>

    @if (Session::has('mensaje'))
      <div class="alert alert-info">
        <p>{{ Session::get('mensaje') }}</p>
      </div>
    @endif

    <table class="table table-striped table-bordered">
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Localización</th>
        <th>Creada en</th>
        <th>Modificada en</th>
        <th>Acciones</th>
      </tr>
      @foreach ($ubicaciones as $ubicacion)
        <tr>
          <td>{{ $ubicacion->id }}</td>
          <td>{{ $ubicacion->nombre }}</td>
          <td>{{ $ubicacion->localizacion }}</td>
          <td>{{ $ubicacion->created_at }}</td>
          <td>{{ $ubicacion->updated_at }}</td>

         <td>{!!  Form::open(['route' => ['ubicaciones.destroy', $ubicacion->id], 'method' => 'DELETE']) !!}
              <input type="submit" class="btn btn-danger" value="eliminar">
              {!! Form::close()!!}
              <a class="btn btn-danger" href="{{ route('ubicaciones.edit') }}">Editar</a>
          </td>
        </tr>
      @endforeach
    </table>

    {!! $ubicaciones->render() !!}
  </div>
</body>
</html>
