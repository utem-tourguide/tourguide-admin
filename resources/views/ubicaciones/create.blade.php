{!! Form::open(['id' => 'formulario']) !!}
  <div class="form-group">
    {!! Form::label('nombre', 'Nombre') !!}
    {!! Form::text('nombre', isset($ubicacion) ? $ubicacion->nombre : '', ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('localizacion', 'Localización') !!}
    {!! Form::text('localizacion', isset($ubicacion) ? $ubicacion->localizacion : '', ['class' => 'form-control']) !!}
  </div>
{!! Form::close() !!}
