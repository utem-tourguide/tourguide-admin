function cargarTablaUsuarios(url) {
  $.ajax({
    url: url,
    success: function(usuario) {
      construirTablaUsuarios(usuario);
    }
  });
}

function construirTablaUsuarios(usuario) {
  $(tabla).fadeOut('fast');
  $('tr.usuarios').remove();
  usuario.forEach(function(usuarios) {
    fila = construirFilaParaUsuarios(usuarios);
    $(tabla).append(fila);
  });
  $(tabla).fadeIn('fast');
}

function construirFilaParaUsuarios(usuarios, nuevo) {
  return $(
    '<tr class="usuarios animado' + (nuevo ? ' nuevo' : '') + '">' +
      '<td>' + usuarios.id + '</td>' +
      '<td>' + usuarios.nombre + '</td>' +
      '<td>' + usuarios.apellido + '</td>' +
      '<td>' + usuarios.idioma + '</td>' +
      '<td>' + usuarios.email + '</td>' +
      '<td>' + usuarios.rol_id + '</td>' +
    '</tr>'
  );
}


function guardarNuevoUsuario(formulario, guardarUrl) {
  $.ajax({
    method: 'POST',
    url: guardarUrl,
    data: $(formulario).serialize(),
    success: function(usuarios) {
      $(usuarioNuevo).modal('hide');
      fila = construirFilaParaUsuarios(usuarios, true);
      $(tabla).append(fila);
      $('html, body').animate({
        scrollTop: $(fila).offset().top
      }, 1000);
      setTimeout(function() {
        $('tr.usuarios.nuevo').removeClass('nuevo');
      }, 3000);
    },
    error: function() {
      alert('Hubo un error.');
    }
  })
}