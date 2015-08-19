@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
	<div class="col-md-6">
		<strong>Bienvenido:  {{ Auth::user()->nombreCompleto() }}</strong>
	</div>
	<div class="col-md-6">
		<strong>Monto acumulado de la venta de postales: {{$total_Ingresadas[0]->total_SolicitudesIngresadas}}</strong>
	</div>
	<br>
	<br>
	<div>
	  <div class="col-md-4">
	  	<p>Ubiciones turísticas más visitadas</p>
	  </div>

	  <div class="col-md-4">
	  	<p>Postales más vendidas</p>
	  </div>

	  <div>
	  	<p>Idiomas más solicitados</p>
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
 