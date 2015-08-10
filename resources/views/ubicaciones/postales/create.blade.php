{!! Form::open(['id' => 'formulario']) !!}
  <div class="form-group">
    {!! Form::label('imagen') !!}
    <div class="thumbnail">
      <img id="postalImagen" {{ isset($postal) ? "src='{$postal->obtenerImagenUrl()}'" : '' }}>
    </div>
    {!! Form::file('imagen', ['id' => 'postalArchivo', 'class' => 'form-control']) !!}
  </div>
{!! Form::close() !!}


