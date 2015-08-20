@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
	<h3>Bienvenido, {{ Auth::user()->nombreCompleto() }}</h3>
	<div class="col-md-6 col-sm-12">
		<strong>Monto acumulado de la venta de postales:</strong>
	</div>
	<br>
	<br>
	<div>
	  <div class="col-md-4 col-sm-12" id="ubicaciones">
	  	<p>Ubiciones turísticas más visitadas</p>
		<div id="compras">
			<canvas id="ubicacionesGrafico" width="100" height="100">
		</div>
	  </div>

	  <div class="col-md-4 col-sm-12">
	  	<p>Postales más vendidas</p>
	  	<div id="postales">
			<canvas id="postalesGrafico" width="100" height="100">
		</div>
	  </div>

	  <div>
	  	<p>Idiomas más solicitados</p>
	  	<div id="idiomas">
			<canvas id="postalesGrafico" width="100" height="100">
		</div>
	  </div>

	</div>
	<br>
	<hr style="">
	<br>
	<div>

		<div class="col-md-4 col-sm-12 well well-sm">
			<p>Últimas ubicaciones añadidas</p>
			<table class="table table-striped table-condensed">
				@foreach($ubicaciones as $ubicacion)
					<tr>
						<td>{{ $ubicacion->nombre }}</td>
						<td>{{ $ubicacion->localizacion }}</td>
					</tr>
				@endforeach
			</table>
		</div>

		<div class="col-md-3 col-sm-12">
			<p>Últimas postales añadidas</p>
			@foreach($postales as $postal)
				<div class="thumbnail">
					<img class="img-responsive" src="{{ $postal->obtenerImagenUrl() }}">
					<div class="caption">
						{{ $postal->ubicacion->nombre }}
					</div>
				</div>
			@endforeach
		</div>

		<div class="col-md-5 col-sm-12 well well-sm">
			<p>Últimos usuarios añadidos</p>
			<table class="table table-striped table-condensed">
				@foreach($usuarios as $usuario)
					<tr>
						<td>{{ $usuario->email }}</td>
						<td>{{ $usuario->rol }}</td>
					</tr>
				@endforeach
			</table>
		</div>

	</div>
@endsection
