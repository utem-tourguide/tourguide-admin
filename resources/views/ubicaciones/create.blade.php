{!! Form::open(['route' => 'ubicaciones.store',
                'id'    => 'ubicacionNuevoFormulario']) !!}
  <div class="form-group">
      <label>Nombre:</label>
      <input type="text" class="form-control" name="nombre">
    </div>
    <div class="form-group">
      <label>Localizacion</label>
      <input type="text" class="form-control" name="localizacion">
    </div>
{!! Form::close() !!}
