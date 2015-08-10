function CRUDRecurso(recurso, baseUrl, tabla, atributos) {
  this.recurso = recurso;
  this.baseUrl = baseUrl;
  this.tabla = tabla;
  this.atributos = atributos;
  this.atributosGenerados = {};
  this.accionesPersonalizadas = {};
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

  this.renderizarAtributos(recurso, fila);
  this.renderizarAtributosGenerados(recurso, fila);
  fila.append(this.crearCeldaAcciones(recurso));

  return fila;
};

CRUDRecurso.prototype.renderizarAtributos = function(recurso, fila) {
  var self = this;
  this.atributos.forEach(function(atributo){
    self.renderizarAtributo(recurso[atributo], fila);
  });
}

CRUDRecurso.prototype.renderizarAtributo = function(valor, fila) {
  $(document.createElement('td'))
            .html(valor)
            .appendTo(fila);
};

CRUDRecurso.prototype.renderizarAtributosGenerados = function(recurso, fila) {
  var valor;
  for (var atributo in this.atributosGenerados) {
    valor = this.atributosGenerados[atributo](recurso);
    this.renderizarAtributo(valor, fila);
  }
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

  this.renderizarAccionesPersonalizadas(recurso, columna);

  $(document.createElement('button'))
    .text('Modificar')
    .addClass('btn btn-default')
    .on('click', function() { self.mostrarDialogoEditar(recurso.id); })
    .appendTo(columna);

  $(document.createElement('button'))
    .text('Eliminar')
    .addClass('btn btn-default')
    .on('click', function() { self.mostrarDialogoEliminar(recurso.id) })
    .appendTo(columna);

  return columna;
};

CRUDRecurso.prototype.renderizarAccionesPersonalizadas = function(recurso, columna) {
  var self = this;

  var boton;
  for (var accion in this.accionesPersonalizadas) {
    boton = $(document.createElement('button'))
      .text(accion)
      .addClass('btn btn-default')
      .appendTo(columna);

    boton.on('click', function() { self.accionesPersonalizadas[accion](recurso, self, boton) })
  }
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

CRUDRecurso.prototype.mostrarDialogoEditar = function(id) {
  var self = this;
  BootstrapDialog.show({
    title: 'Editar ' + this.recurso,
    message: $('<div></div>').load(this.baseUrl + '/' + id +'/edit'),
    buttons: [
      {
        label: 'Guardar',
        cssClass: 'btn-primary',
        action: function(dialogo) {
          self.guardarRecurso(id, function() {
            dialogo.close();
            $('html, body').animate({ scrollTop: $(".nuevo").offset().top }, 500);
          });
        }
      }
    ]
  });
};

CRUDRecurso.prototype.mostrarDialogoEliminar = function(id) {
  var self = this;
  BootstrapDialog.show({
    title: 'Eliminar ' + this.recurso,
    message: '¿Confirma que desea eliminar el recurso de ' + this.recurso + ' seleccionado?',
    buttons: [
      {
        label: 'Eliminar',
        cssClass: 'btn-danger',
        action: function(dialogo) {
          self.eliminarRecurso(id, function() {
            dialogo.close();
          });
        }
      }
    ]
  });
};

CRUDRecurso.prototype.guardarRecurso = function(id, callback) {
  var self = this;
  $('#formulario').submit(function(e) {
    e.preventDefault();

    $(this).ajaxSubmit({
      url: self.baseUrl + (id ? ('/' + id) : ''),
      method: id ? 'patch' : 'post',
      success: function(recurso) {
        self.actualizarFila(recurso);
        callback && callback();
      }
    });
  }).submit();
};

CRUDRecurso.prototype.eliminarRecurso = function(id, callback) {
  var self = this;
  $.ajax({
    url: this.baseUrl + '/' + id,
    method: 'delete',
    success: function() {
      self.eliminarFila(id);
      callback && callback();
    }
  });
};

CRUDRecurso.prototype.actualizarFila = function(recurso) {
  var viejaFila = $('tr[data-id=' + recurso.id + ']');
  var nuevaFila = this.construirFila(recurso, true);
  if (viejaFila.length > 0) {
    nuevaFila.insertAfter(viejaFila);
    viejaFila.remove();
  } else {
    nuevaFila.appendTo(this.tabla);
  }
};

CRUDRecurso.prototype.eliminarFila = function(id) {
  $('tr[data-id=' + id + ']').remove();
};

CRUDRecurso.prototype.agregarAccionPersonalizada = function(nombre, closure) {
  this.accionesPersonalizadas[nombre] = closure;
};

CRUDRecurso.prototype.agregarAtributoGenerado = function(nombre, closure) {
  this.atributosGenerados[nombre] = closure;
}
