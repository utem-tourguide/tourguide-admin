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
			<div class="form-group">
		    	<label>Nombre:</label>
		    	<input type="text" class="form-control" name="nombre">
		  	</div>
		  	<div class="form-group">
		    	<label>Apellido:</label>
		    	<input type="text" class="form-control" name="apellido">
		  	</div>
		  	<div class="form-group">
		    	<label>Email:</label>
		    	<input type="email" class="form-control" name="email">
		  	</div>
		  	<div class="form-group">
		    	<label>Rol:</label>
		    	<select name="rol_id" class="btn">
		    		<option value="{{ ROL_ADMINISTRADOR }}">Administrador</option>
		    		<option value="{{ ROL_TURISTA }}">Turista</option>
		    	</select>
		  	</div>
		  	<div class="form-group">
		    	<label>Contraseña:</label>
		    	<input type="password" class="form-control" name="contrasena">
		  	</div>
		  	<div class="form-group">
		    	<label>Confirmar Contraseña:</label>
		    	<input type="password" class="form-control" name="confirmar_contrasena">
		  	</div>
		  	<div class="form-group">
		  		<label>Idioma</label>
		  		<select class="btn" name="idioma">
					<option value="es">Español</option>
					<option value="en">Ingles</option>
					<option value="fr">Frances</option>
				</select>
		  	</div>
			<input type="submit" value="Guardar" class=" btn btn-primary">
		{!! Form::close() !!}
	</div>
	<div class="col-md-3">
	</div>
</body>
</html>