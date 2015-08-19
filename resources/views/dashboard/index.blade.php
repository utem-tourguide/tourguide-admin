@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
	<div class="col-md-6">
		<strong>Bienvenido:  {{ Auth::user()->nombreCompleto() }}</strong>
	</div>
	<div class="col-md-6">
		<strong>Monto acumulado de la venta de postales:</strong>
	</div>
	<br>
	<br>
	<div>
	  <div class="col-md-4" id="ubicaciones">
	  	<p>Ubiciones turísticas más visitadas</p>
		<div id="compras">
			<canvas id="ubicacionesGrafico" width="100" height="100">
		</div>
	  </div>

	  <div class="col-md-4">
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
		<div class="col-md-4">
			<table class="table table-striped table-hover">
				<tr>
					<td>
						ID
					</td>
					<td>
						Nombre
					</td>
					<td>
						Localización
					</td>
				</tr>
				<tr>
				</tr>
			</table>
		</div>
		<div class="col-md-2">
			<table class="table table-striped table-hover">
				<tr>
					<td>
						ID
					</td>
					<td>
						Nombre
					</td>
				</tr>
				<tr>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<table class="table table-striped table-hover">
				<tr>
					<td>
						ID
					</td>
					<td>
						Nombre
					</td>
					<td>
						Apellido
					</td>
					<td>
						Idioma
					</td>
					<td>
						Email
					</td>
				</tr>
				<tr>
				</tr>
			</table>
		</div>
	</div>
@endsection
@section('scripts')
			<script>
			window.onload = cargarGraficaUbicaciones;

			var chart;
			Chart.defaults.global.responsive = true;

			function cargarGraficaUbicaciones() {
				$.ajax({
					method: 'GET',
					url: '{{ route('ubicaciones.index') }}',
					data: $('#filtros').serialize(),
					success: function(ubiciones) {
						mostrarGraficaUbicaciones(Ubiciones);
					}
				});
			}

			function mostrarGraficaUbicaciones(datos) {
				if (chart) chart.destroy();

				var contexto = $('#ubicacionesGrafico').get(0).getContext('2d');
				chart = new Chart(contexto).Line(datos);
			}

			$('#filtros').submit(function(e) {
				e.preventDefault();

				cargarGraficaUbicaciones();
			});
			</script>
			@endsection