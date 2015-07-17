<div class="modal fade" id="ubicacionNuevo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nueva ubicación turística</h4>
      </div>
      <div class="modal-body">
        @include('ubicaciones.create')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"
        data-dismiss="modal">Cancelar</button>
        <button type="button"
                class="btn btn-primary"
                onclick="guardarNuevaUbicacion(formularioNuevo, '{{ route('ubicaciones.store') }}')">
                  Guardar
        </button>
      </div>
    </div>
  </div>
</div>
