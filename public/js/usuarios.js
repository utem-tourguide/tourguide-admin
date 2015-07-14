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
    '<tr class="usuarios animado' + (nuevo ? ' nuevo' : '') + '" data-usuario-id="' + usuarios.id + '">' +
      '<td>' + usuarios.id + '</td>' +
      '<td>' + usuarios.nombre + '</td>' +
      '<td>' + usuarios.apellido + '</td>' +
      '<td>' + usuarios.idioma + '</td>' +
      '<td>' + usuarios.email + '</td>' +
      '<td>' + usuarios.rol_id + '</td>' +
      '<td>' + '<button onclick="mostrarDialogoParaEditar('+ usuarios.id +')" class="btn btn-warning">Editar</button>' + 
      '<button class="btn btn-danger" onclick="eliminar('+ usuarios.id +')"> Eliminar </button>' + '</td>' +
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

function mostrarDialogoParaEditar (usuarioId) {
  $.ajax({
    method: 'GET',
    url: '/usuarios/' + usuarioId,
    success: function(usuarios) {
      formularioEditar.nombre.value = usuarios.nombre;
      formularioEditar.apellido.value = usuarios.apellido;
      formularioEditar.idioma.value = usuarios.idioma;
      formularioEditar.email.value = usuarios.email;
      formularioEditar.contrasena.value = usuarios.contrasena;
      formularioEditar.confirmar_contrasena.value = usuarios.confirmar_contrasena;
      $(formularioEditar).attr('data-usuario-id', usuarioId);
      $(usuariosEditar).modal();
    }
  });
}

function actualizarUsuarios(formulario) {
  id = $(formulario).attr('data-usuario-id');
  $.ajax({
    method: 'PATCH',
    url: '/usuarios/' + id,
    data: $(formulario).serialize(),
    success: function(usuario) {
      $(usuariosEditar).modal('hide'); // Cierra el dialogo de edición
      actualizarFilaParaUsuarios(usuario);
    } 
  });
}

function actualizarFilaParaUsuarios(usuario) {
  fila = $('tr[data-usuario-id=' + usuario.id + ']');
  $(fila.children()[1]).text(usuario.nombre);
  $(fila.children()[2]).text(usuario.epellido);
  $(fila.children()[3]).text(usuario.idioma);
  $(fila.children()[4]).text(usuario.email);
}