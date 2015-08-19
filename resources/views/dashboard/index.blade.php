@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
	<p>Bienvenido:  {{ Auth::user()->nombreCompleto() }}</p>
	<br>
	<div>
	  <div class="col-md-4">
	  	<p>Ubiciones turísticas más visitadas</p>
	  </div>
	  <div class="col-md-4">
	  	<p>Postales más vendidas</p>
	  	{{}}
	  </div>
	  <div class="col-md-4">
	  	<p>Idiomas más solicitados</p>
	  </div>
	</div>
	<div>
		<div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>
	</div>
@endsection
 