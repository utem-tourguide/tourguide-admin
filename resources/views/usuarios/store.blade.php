<html>
<head>
	<title>Usuario creado -Tourguide Admin</title>
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
	<div class="container-fluid">
	    <h3>Usuario creado</h3>

	    <p>El usuario "{{ $usuario->nombre }}" ha sido creado.</p>

	    <p>
	      {!! link_to_route('usuarios.index', 'Volver a lista de usuarios') !!}
	    </p>
  </div>
</body>
</html>