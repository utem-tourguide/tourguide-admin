{!! Form::model(isset($postal) ? $postal : null, ['id' => 'formulario', 'files' => true]) !!}
  <div class="form-group">
    {!! Form::label('imagen') !!}
    <div class="thumbnail well">
      <img id="postalImagen" {{ isset($postal) ? "src={$postal->obtenerImagenUrl()}" : '' }}>
      {!! Form::file('imagen', ['id' => 'postalArchivo', 'class' => 'form-control']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('precio') !!}
    {!! Form::text('precio', null, ['class' => 'form-control']) !!}
  </div>
{!! Form::close() !!}
