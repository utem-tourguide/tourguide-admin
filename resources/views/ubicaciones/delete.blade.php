<<html>
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
</html>

<!--@if ($action == 'eliminar')  
{{ Form::model($user, array('route' => array('ubicacionesController.destroy', $user->id), 'method' => 'DELETE', 'role' => 'form')) }}
  <div class="row">
    <div class="form-group col-md-4">
        {{ Form::submit('Eliminar ubicacion', array('class' => 'btn btn-danger')) }}
    </div>
  </div>
{{ Form::close() }}
@endif-->
<!--{!! form:: open (['route'=['administrar.ubicaciones.index', ubicacion-id], 'method' => 'DELETE', 'id'=> 'form-danger'])!!}
{!!form::close()!!}-->