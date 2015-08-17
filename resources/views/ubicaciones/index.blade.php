@extends('layouts.admin')

@section('title', 'Administrar ubicaciones turísticas')

@section('content')
  <h1>Ubicaciones turísticas</h1>

  <div class="well well-sm">
    <button id="nuevaUbicacion" class="btn btn-primary">Nueva ubicación</button>
  </div>

  <table id="ubicaciones" class="table table-striped table-bordered" hidden>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Localización</th>
      <th>Creada en</th>
      <th>Modificada en</th>
      <th>Acciones</th>
    </tr>
  </table>
@endsection

@section('scripts')
  @parent
  <script>
    crud = new CRUDRecurso('ubicación turística',
                            '{{ route('ubicaciones.index') }}',
                            $('#ubicaciones'),
                            ['id', 'nombre', 'localizacion', 'created_at', 'updated_at']);

    crud.agregarAccionPersonalizada('Información', function(recurso, crud, boton) {
      var url = ('{{ route('administrar.ubicaciones.informacion', ['placeholder']) }}');
      url = url.replace('placeholder', recurso.id);

      window.location = url; // ¡Esto causará un cambio de página!
    });

    crud.agregarAccionPersonalizada('Postales', function(recurso, crud, boton) {
      var url = ('{{ route('administrar.ubicaciones.postales', ['id']) }}').replace('id', recurso.id);
      window.location = url;
    });

    crud.cargarTabla();
    $('#nuevaUbicacion').on('click', function() { crud.mostrarDialogoNuevo() });
  </script>
@endsection
