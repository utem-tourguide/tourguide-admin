<html>
<head>
	<title>Modificar Ubicaciones - TourGuide Admin</title>
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
	<div class="col-md-3">
	</div>
	<div class="col-md-6 form-group">
		{!! Form::open(['route' => ['ubicaciones.update', $ubicaciones->id], 'method' => 'PATCH']) !!}
			<div class="form-group">
		    	<label>Nombre:</label>
		    	<input type="text" class="form-control" name="nombre" value="{{ $ubicaciones->nombre }}">
		  	</div>
		  	<div class="form-group">
		    	<label>Localizacion</label>
		    	<input type="text" class="form-control" name="localizacion" value="{{ $ubicaciones->localizacion }}">
		  	</div>
			<input type="submit" value="Guardar" class=" btn btn-primary"><a href="{{ route('ubicaciones.index') }}" class="btn btn-danger" style="margin: 2em;">Cancelar</a>
		{!! Form::close() !!}
	</div>
	<div class="col-md-3">
	</div>
</body>
</html>