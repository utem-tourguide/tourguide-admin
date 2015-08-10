{!! Form::open(['id' => 'formulario']) !!}
  <div class="form-group">
    {!! Form::label('imagen') !!}
    <div class="thumbnail">
      <img id="postalImagen" {{ isset($postal) ? "src='{$postal->obtenerImagenUrl()}'" : '' }}>
    </div>
    {!! Form::file('imagen', ['id' => 'postalArchivo', 'class' => 'form-control']) !!}
  </div>

  <div class="form-group">
    {!! Form::label('precio') !!}
    {!! Form::text('precio', '', ['class' => 'form-control']) !!}
  </div>
{!! Form::close() !!}


