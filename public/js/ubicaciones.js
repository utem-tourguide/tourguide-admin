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

function construirFilaParaUbicacion(ubicacion) {
  return $(
    '<tr class="ubicacion">' +
      '<td>' + ubicacion.id + '</td>' +
      '<td>' + ubicacion.nombre + '</td>' +
      '<td>' + ubicacion.localizacion + '</td>' +
      '<td>' + ubicacion.created_at + '</td>' +
      '<td>' + ubicacion.updated_at + '</td>' +
    '</tr>'
  );
}
