@extends('layouts.admin')

@section('title', 'Administrar postales')

@section('content')
  <h3>Administrar postales para {{ $ubicacion->nombre }}</h3>

  <p>
    En esta página puedes administrar las postales almacenadas sobre la ubicación turística "{{ $ubicacion->nombre }}". Para añadir una postal, haz clic en <strong>Nueva postal</strong>. Para modificar o eliminar alguna postal, haz clic en el botón <strong>Modificar</strong> o <strong>Eliminar</strong> que corresponda.
  </p>

  <div class="well">
    <button id="nuevaPostal" class="btn btn-primary">Nueva postal</button>
  </div>

  <div class="table-responsive">
    <table id="postales" class="table table-striped table-condensed" hidden>
      <tr>
        <th>ID</th>
        <th>Precio</th>
        <th>Imagen</th>
        <th>Acciones</th>
      </tr>
    </table>
  </div>
@endsection

@section('scripts')
  @parent
  <script src="/js/image_previewer.js"></script>
  <script>
   crud = new CRUDRecurso('postal',
                          '{{ route('ubicaciones.postales.index', [$ubicacion->id]) }}',
                          $('#postales'),
                          ['id']);
   crud.modificarRecursos = false;

   crud.agregarAtributoGenerado('Precio', function(recurso) {
     return '$' + recurso.precio;
   });

   crud.agregarAtributoGenerado('Imagen', function(recurso) {
     var url = '{{asset(\TourGuide\Models\Postal::IMAGENES_PATH.'/id?')}}'
       .replace('id', recurso.id);

     var img = $('<img class="thumbnail" src="' + url + new Date().getTime() + '">');
     img.click(function() { ImagePreviewer.showPicture(url) });

     return img;
   });

   crud.opciones = {
     modificar: {
       method: 'post'
     }
   };

   crud.cargarTabla();

   $('#nuevaPostal').on('click', function() { crud.mostrarDialogoNuevo() });

   $('body').on('change', '#postalArchivo', function() {
    var previewer = new ImagePreviewer(this);
    previewer.render('#postalImagen');
   });
 </script>
@endsection
