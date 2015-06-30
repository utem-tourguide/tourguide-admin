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
    '<tr class="ubicacion animado' + (nuevo ? ' nuevo' : '') + '">' +
      '<td>' + ubicacion.id + '</td>' +
      '<td>' + ubicacion.nombre + '</td>' +
      '<td>' + ubicacion.localizacion + '</td>' +
      '<td>' + ubicacion.created_at + '</td>' +
      '<td>' + ubicacion.updated_at + '</td>' +
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
