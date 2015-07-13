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

    <div class="well well-sm">
      {!! link_to_route('ubicaciones.create', 'Nuevo ubicacion', [], ['class' => "btn btn-primary"]) !!}
    </div>

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
          <td>
            <a class="btn btn-primary btn-sm" href="{{ route('ubicaciones.edit', [$ubicacion->id]) }}">Editar</a>

            {!!  Form::open(['route' => ['ubicaciones.destroy', $ubicacion->id], 'method' => 'DELETE', 'style' => 'display: inline-block']) !!}
              <input type="submit" class="btn btn-danger btn-sm" value="eliminar">
            {!! Form::close()!!}
          </td>
        </tr>
      @endforeach
    </table>

    {!! $ubicaciones->render() !!}
  </div>
</body>
</html>
