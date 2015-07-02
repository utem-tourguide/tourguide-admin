{!! Form::open(['route' => 'usuarios.store',
                'id'    => 'usuarioNuevoFormulario']) !!}

    <div class="form-group">
    	<label>Nombre:</label>
    	<input type="text" class="form-control" name="nombre">
    </div>
    <div class="form-group">
    	<label>Apellido:</label>
    	<input type="text" class="form-control" name="apellido">
    </div>
    <div class="form-group">
        <label>Idioma</label>
        <select name="idioma">
            <option value="es">Español</option>
            <option value="en">Ingles</option>
            <option value="fr">Frances</option>
        </select>
    </div>
    <div class="form-group">
    	<label>Email:</label>
    	<input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
    	<label>Rol:</label>
    	<select name="rol_id">
    		<option value="Administrador">Administrador</option>
    		<option value="Turista">Turista</option>
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
{!! Form::close() !!}