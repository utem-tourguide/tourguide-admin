<div class="modal fade" id="ubicacionEditar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar ubicación</h4>
      </div>
      <div class="modal-body">
        @include('ubicaciones.edit')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"
        data-dismiss="modal">Cancelar</button>
        <button type="button"
                class="btn btn-primary"
                onclick="actualizarUbicacion(formularioEditar)">
                  Guardar
        </button>
      </div>
    </div>
  </div>
</div>
