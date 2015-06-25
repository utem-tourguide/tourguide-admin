<html>
<head>
	<title>Usuarios - TourGuide Admin</title>
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
	<div class="col-md-3">
	</div>
	<div class="col-md-6 form-group">
		{!! Form::open(['route' => 'usuarios.store']) !!}
			@include('usuarios.partials.formulario')
		{!! Form::close() !!}
	</div>
	<div class="col-md-3">
	</div>
</body>
</html>