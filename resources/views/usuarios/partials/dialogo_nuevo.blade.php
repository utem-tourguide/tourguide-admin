<div class="modal fade" id="usuarioNuevo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nuevo Usuario</h4>
      </div>
      <div class="modal-body">
        @include('usuarios.create')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"
        data-dismiss="modal">Cancelar</button>
        <button type="button"
                class="btn btn-primary"
                onclick="guardarNuevoUsuario(usuarioNuevoFormulario, '{{ route('usuarios.store') }}')">
                  Guardar
        </button>
      </div>
    </div>
  </div>
</div>