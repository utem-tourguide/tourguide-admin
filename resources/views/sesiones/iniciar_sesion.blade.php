<!DOCTYPE html>
<html>
<head>
  <title>Entrar a TourGuide Admin</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>
<body>

  <div class="container-fluid">

    <div class="row">

      <div class="col-xs-12">
        <img id="app-logo" src="{{ asset('images/tourguide-logo.jpg') }}">

        <div id="login_form" class="well well-lg">
          @if (Session::has( 'error' ))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
          @endif
          {!! Form::open(['route' => 'sesiones.entrar']) !!}
            {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Correo electrónico', 'required']) !!}
            {!! Form::password('contrasena', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required']) !!}
            {!! Form::submit('Entrar', ['class' => 'btn btn-large btn-primary btn-block']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>

  </div>

  <footer class="text-center">
    &copy; 2015 TourGuide Team
  </footer>

</body>
</html>
