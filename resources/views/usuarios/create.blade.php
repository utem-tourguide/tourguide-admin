{!! Form::model(isset($usuario) ? $usuario : null, ['id' => 'formulario']) !!}
  <div class="form-group">
    {!! Form::label('nombre') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('apellido') !!}
    {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('idioma') !!}
    {!! Form::select('idioma', ['es' => 'Español',
                                'en' => 'Inglés',
                                'fr' => 'Francés'],
                                null,
                                ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('email') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('rol') !!}
    {!! Form::select('rol_id', [1 => 'Administrador',
                                2 => 'Turista'],
                                null,
                                ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('contrasena') !!}
    {!! Form::password('contrasena', ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('confirmar contrasena') !!}
    {!! Form::password('contrasena_confirmation', ['class' => 'form-control']) !!}
  </div>
{!! Form::close() !!}
