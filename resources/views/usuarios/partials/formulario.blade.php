




<div class="form-group">
	<label>Nombre:</label>
	<input type="text" class="form-control" name="nombre" value="{{ $usuario->nombre }}">
</div>
<div class="form-group">
	<label>Apellido:</label>
	<input type="text" class="form-control" name="apellido" value="{{ $usuario->apellido }}">
</div>
<div class="form-group">
	<label>Idioma</label>
	{!! Form::select('idioma', ['es' => 'Español', 'en' => 'Ingles', 'fr' => 'Frances'], $usuario->idioma) !!}
</div>
<div class="form-group">
	<label>Email:</label>
	<input type="email" class="form-control" name="email" value="{{ $usuario->email }}">
</div>
<div class="form-group">
	<label>Rol:</label>
	{!! Form::select('rol_id', [ROL_ADMINISTRADOR => 'Administrador', ROL_TURISTA => 'Turista'], $usuario->rol_id) !!}
</div>
<div class="form-group">
	<label>Contraseña:</label>
	<input type="password" class="form-control" name="contrasena">
</div>
<div class="form-group">
	<label>Confirmar Contraseña:</label>
	<input type="password" class="form-control" name="confirmar_contrasena">
</div>
<input type="submit" value="Guardar" class=" btn btn-primary"><a href="{{ route('usuarios.index') }}" class="btn btn-danger" style="margin: 2em;">Cancelar</a>