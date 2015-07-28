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
    fila = self.construirFila(recurso);
    $(self.tabla).append(fila);
  });
  $(this.tabla).fadeIn('fast');
};

CRUDRecurso.prototype.construirFila = function(recurso, esNuevo) {
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
    .attr('data-id', recurso.id);

  esNuevo && fila.addClass('nuevo');

  return fila;
};

CRUDRecurso.prototype.crearCeldaAcciones = function(recurso) {
  var self = this;
  var columna = $(document.createElement('td'));

  $(document.createElement('button'))
    .text('Modificar')
    .addClass('btn btn-default')
    .on('click', function() { self.mostrarDialogoEditar(recurso.id); })
    .appendTo(columna);

  $(document.createElement('button'))
    .text('Eliminar')
    .addClass('btn btn-default')
    .on('click', function() { })
    .appendTo(columna);

  return columna;
};

CRUDRecurso.prototype.mostrarDialogoNuevo = function() {
  var self = this;
  BootstrapDialog.show({
    title: 'Crear ' + this.recurso,
    message: $('<div></div>').load(this.baseUrl + '/create'),
    buttons: [
      {
        label: 'Guardar',
        cssClass: 'btn-primary',
        action: function(dialogo) {
          self.guardarRecurso(null, function() {
            dialogo.close();
            $('html, body').animate({ scrollTop: $(".nuevo").offset().top }, 500);
          });
        }
      }
    ]
  });
};

CRUDRecurso.prototype.guardarRecurso = function(recurso, callback) {
  var self = this;
  $.ajax({
    url: this.baseUrl + (recurso ? ('/' + recurso.id) : ''),
    method: recurso ? 'patch' : 'post',
    data: $('#formulario').serialize(),
    success: function(recurso) {
      self.actualizarFila(recurso);
      callback();
    }
  });
};

CRUDRecurso.prototype.actualizarFila = function(recurso) {
  var fila = $('tr[data-id=' + recurso.id + ']');
  if (fila.count > 0) {
    var columnas = fila.children();
    this.atributos.forEach(function(atributo, indice) {
      columnas[indice].text(recurso[atributo]);
    });
  } else {
    this.construirFila(recurso, true).appendTo(this.tabla);
  }
};
