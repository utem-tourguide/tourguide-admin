<div class="modal fade" id="usuariosEditar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Usuario</h4>
      </div>
      <div class="modal-body">
        @include('usuarios.edit')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"
        data-dismiss="modal">Cancelar</button>
        <button type="button"
                class="btn btn-primary"
                onclick="actualizarUsuarios(formularioEditar)">
                  Guardar
        </button>
      </div>
    </div>
  </div>
</div>
