function CRUDRecurso(recurso, baseUrl, tabla, atributos) {
  this.recurso = recurso;
  this.baseUrl = baseUrl;
  this.tabla = tabla;
  this.atributos = atributos;
}

CRUDRecurso.prototype.cargarTabla = function() {
  var self = this;
  $.ajax({
    url: this.baseUrl,
    success: function(recursos) {
      self.construirTabla(recursos);
    }
  });
};

CRUDRecurso.prototype.construirTabla = function(recursos) {
  var self = this;
  $(this.tabla).fadeOut('fast');
  $('tr.' + this.recurso).remove();
  var fila;
  recursos.forEach(function(recurso) {
    fila = self.construirFilaParaRecurso(recurso);
    $(self.tabla).append(fila);
  });
  $(this.tabla).fadeIn('fast');
};

CRUDRecurso.prototype.construirFilaParaRecurso = function(recurso, esNuevo) {
  var fila = this.iniciarFilaRecurso(recurso, esNuevo);

  var columna;
  this.atributos.forEach(function(atributo){
    columna = $(document.createElement('td'))
      .text(recurso[atributo])
      .appendTo(fila);
  });

  fila.append(this.crearCeldaAcciones(recurso));

  return fila;
};

CRUDRecurso.prototype.iniciarFilaRecurso = function(recurso, esNuevo) {
  var fila = $(document.createElement('tr'))
    .addClass('recurso')
    .addClass('animado')
    .data('recurso-id', recurso.id);

  esNuevo && fila.addClass('nuevo');

  return fila;
};

CRUDRecurso.prototype.crearCeldaAcciones = function(recurso) {
  var self = this;
  var columna = $(document.createElement('td'));

  $(document.createElement('button'))
    .text('Modificar')
    .addClass('btn btn-default')
    .on('click', function() { self.mostrarEditar(recurso.id); })
    .appendTo(columna);

  $(document.createElement('button'))
    .text('Eliminar')
    .addClass('btn btn-default')
    .on('click', function() { })
    .appendTo(columna);

  return columna;
};

CRUDRecurso.prototype.guardarNuevoRecurso = function(formulario) {
  $.ajax({
    method: 'POST',
    url: this.baseUrl,
    data: $(formulario).serialize(),
    success: function(ubicacion) {
      $(ubicacionNuevo).modal('hide');
      fila = construirFilaParaRecurso(ubicacion, true);
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
};

CRUDRecurso.prototype.mostrarNuevo = function() {
  BootstrapDialog.show({
    title: 'Crear ' + this.recurso,
    message: $('<div></div>').load(this.baseUrl + '/create')
  });
};

CRUDRecurso.prototype.mostrarEditar = function(id) {
  BootstrapDialog.show({
    title: 'Editar ' + this.recurso,
    message: $('<div></div>').load(this.baseUrl + '/' + id + '/edit')
  });
};

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

