{!! Form::open(['id' => 'formulario']) !!}
  {!! Form::label('contenido', 'Contenido') !!}
  {!! Form::textarea('contenido', isset($informacion) ? $informacion->contenido : '', ['class' => 'form-control']) !!}

  {!! Form::label('idioma', 'Idioma') !!}
  {!! Form::select('idioma', ['es' => 'Español',
                              'en' => 'Inglés',
                              'fr' => 'Francés'],
                              isset($informacion) ? $informacion->idioma : null,
                              ['class' => 'form-control']) !!}
{!! Form::close() !!}
