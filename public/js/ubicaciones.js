function cargarTablaUbicaciones(url) {
  $.ajax({
    url: url,
    success: function(ubicaciones) {
      construirTablaUbicaciones(ubicaciones);
    }
  });
}

function construirTablaUbicaciones(ubicaciones) {
  $(tabla).fadeOut('fast');
  $('tr.ubicacion').remove();
  ubicaciones.forEach(function(ubicacion) {
    fila = construirFilaParaUbicacion(ubicacion);
    $(tabla).append(fila);
  });
  $(tabla).fadeIn('fast');
}

function construirFilaParaUbicacion(ubicacion, nuevo) {
  return $(
    '<tr class="ubicacion animado' + (nuevo ? ' nuevo' : '') + '" data-ubicacion-id="' + ubicacion.id + '">' +
      '<td>' + ubicacion.id + '</td>' +
      '<td>' + ubicacion.nombre + '</td>' +
      '<td>' + ubicacion.localizacion + '</td>' +
      '<td>' + ubicacion.created_at + '</td>' +
      '<td>' + ubicacion.updated_at + '</td>' +
      '<td>' +
        '<a href="/administrar/ubicaciones/' + ubicacion.id + '/informacion" ' +
           'class="btn btn-primary">' +
           'Información' +
        '</a>' +
        '<button onclick="mostrarDialogoParaEditar('+ ubicacion.id +')" ' +
                 'class="btn btn-warning">' +
          'Editar' +
        '</button>' +
        '<button class="btn btn-danger"> Eliminar </button>' +
      '</td>' +
    '</tr>'
  );
}

function guardarNuevaUbicacion(formulario, guardarUrl) {
  $.ajax({
    method: 'POST',
    url: guardarUrl,
    data: $(formulario).serialize(),
    success: function(ubicacion) {
      $(ubicacionNuevo).modal('hide');
      fila = construirFilaParaUbicacion(ubicacion, true);
      $(tabla).append(fila);
      $('html, body').animate({
        scrollTop: $(fila).offset().top
      }, 1000);
      setTimeout(function() {
        $('tr.ubicacion.nuevo').removeClass('nuevo');
      }, 3000);
    },
    error: function() {
      alert('Hubo un error.');
    }
  })
}

function mostrarDialogoParaEditar (ubicacionId) {
  $.ajax({
    method: 'GET',
    url: '/ubicaciones/' + ubicacionId,
    success: function(ubicacion) {
      formularioEditar.nombre.value = ubicacion.nombre;
      formularioEditar.localizacion.value = ubicacion.localizacion;
      $(formularioEditar).attr('data-ubicacion-id', ubicacionId);
      $(ubicacionEditar).modal();
    }
  });
}

function actualizarUbicacion(formulario) {
  id = $(formulario).attr('data-ubicacion-id');
  $.ajax({
    method: 'PATCH',
    url: '/ubicaciones/' + id,
    data: $(formulario).serialize(),
    success: function(ubicacion) {
      $(ubicacionEditar).modal('hide'); // Cierra el dialogo de edición
      actualizarFilaParaUbicacion(ubicacion);
    }
  });
}

function actualizarFilaParaUbicacion(ubicacion) {
  fila = $('tr[data-ubicacion-id=' + ubicacion.id + ']');
  $(fila.children()[1]).text(ubicacion.nombre);
  $(fila.children()[2]).text(ubicacion.localizacion);
  $(fila.children()[4]).text(ubicacion.updated_at);
}

