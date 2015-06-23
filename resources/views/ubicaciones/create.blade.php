<html>
<head>
	<title>Usuarios - TourGuide Admin</title>
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
	<div class="col-md-3">
	</div>
	<div class="col-md-6 form-group">
		<form>
			<div class="form-group">
		    	<label>Nombre:</label>
		    	<input type="text" class="form-control" name="nombre">
		  	</div>
		  	<div class="form-group">
		    	<label>Localizacion</label>
		    	<input type="tex" class="form-control" name="localizacion">
		  	</div>
			<input type="submit" value="Guardar" class=" btn btn-primary"><a href="{{ route('ubicaciones.index') }}" class="btn btn-danger" style="margin: 2em;">Cancelar</a>
		</form>
	</div>
	<div class="col-md-3">
	</div>
</body>
</html>