function CRUDRecurso(recurso, baseUrl, tabla, atributos) {
  this.recurso = recurso;
  this.baseUrl = baseUrl;
  this.tabla = tabla;
  this.atributos = atributos;
  this.modificarRecursos = true;

  this.atributosGenerados = {};
  this.accionesPersonalizadas = {};

  this.opciones = {
    crear: {},
    modificar: {},
    eliminar: {}
  };
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
  var toolbar = $(document.createElement('div')).addClass('btn-group');

  this.renderizarAccionesPersonalizadas(recurso, toolbar);

  if (this.modificarRecursos) {
    $(document.createElement('button'))
      .attr('title', 'Modificar')
      .addClass('btn btn-primary btn-xs')
      .on('click', function () {
        self.mostrarDialogoEditar(recurso.id);
      }).append($('<span class="glyphicon glyphicon-edit"></span>'))
      .appendTo(toolbar);
  }

  $(document.createElement('button'))
    .attr('title', 'Eliminar')
    .addClass('btn btn-danger btn-xs')
    .on('click', function() { self.mostrarDialogoEliminar(recurso.id) })
    .append($('<span class="glyphicon glyphicon-remove"></span>'))
    .appendTo(toolbar);

  toolbar.appendTo(columna);

  return columna;
};

CRUDRecurso.prototype.renderizarAccionesPersonalizadas = function(recurso, columna) {
  var boton;

  for (var accion in this.accionesPersonalizadas) {
    boton = this.crearBotonDeAccion(recurso,
                                    accion,
                                    this.accionesPersonalizadas[accion][0],
                                    this.accionesPersonalizadas[accion][1]);
    boton.appendTo(columna);
  }
};

CRUDRecurso.prototype.crearBotonDeAccion = function(recurso, titulo, accion, icono) {
  var boton = $(document.createElement('button')).addClass('btn btn-success btn-xs');

  if (icono) {
    boton.attr('title', titulo).append('<span class="glyphicon glyphicon-' + icono + '"></span>');
  } else {
    boton.text(titulo);
  }

  var self = this;
  boton.on('click', function() {
    accion(recurso, self, boton);
  });

  return boton;
};

CRUDRecurso.prototype.mostrarDialogoNuevo = function() {
  var self = this;
  BootstrapDialog.show({
    title: 'Crear ' + this.recurso,
    message: $('<div></div>').load(this.baseUrl + '/create'),
    buttons: [
      {
        label: 'Guardar',
        cssClass: 'btn-primary btn-sm',
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
        cssClass: 'btn-primary btn-sm',
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
        cssClass: 'btn-danger btn-sm',
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
  $('#formulario').off('submit').on('submit', function(e) {
    e.preventDefault();

    var opciones = {
      url: self.baseUrl + (id ? ('/' + id) : ''),
      method: id ? 'patch' : 'post',
      success: function(recurso) {
        self.actualizarFila(recurso);
        callback && callback();
      },
      error: function(respuesta) {
        switch (respuesta.status) {
          case 422: self.mostrarErroresDeGuardado(respuesta.responseJSON);
        }
      }
    };

    $(this).ajaxSubmit($.extend({}, opciones, id ? self.opciones.modificar: self.opciones.crear));
  }).submit();
};

CRUDRecurso.prototype.mostrarErroresDeGuardado = function(errores) {
  var contenedor = $(document.createElement('div')).attr('id', 'errores')
                                                   .addClass('alert alert-danger');

  var formulario = $('#formulario');
  this.mostrarMensajesDeError(errores, contenedor, formulario);
  this.marcarCamposConErrorEnFormulario(formulario, errores);
  this.doBounce(formulario, 3, '10px', 70);
};

CRUDRecurso.prototype.mostrarMensajesDeError = function(errores, contenedor, formulario) {
  $('#errores').remove();

  var error;
  for (error in errores) {
    errores[error].forEach(function(error) {
      contenedor.append('<p>' + error + '</p>');
    });
  }

  contenedor.insertBefore(formulario);
};

CRUDRecurso.prototype.marcarCamposConErrorEnFormulario = function(formulario, errores) {
  $('.has-error').removeClass('has-error');

  var nombre;
  formulario.find('.form-control').each(function() {
    nombre = $(this).attr('name');
    if (errores[nombre]) {
      $(this).parent().addClass('has-error');
    }
  });
};

CRUDRecurso.prototype.doBounce = function(element, times, distance, speed) {
  for(var i = 0; i < times; i++) {
    element.animate({marginTop: '-='+distance}, speed)
      .animate({marginTop: '+='+distance}, speed);
  }
};

CRUDRecurso.prototype.eliminarRecurso = function(id, callback) {
  var self = this;

  var opciones = {
    url: this.baseUrl + '/' + id,
    method: 'delete',
    success: function() {
      self.eliminarFila(id);
      callback && callback();
    },
    error: function(errores) {
      self.mostrarErroresDeGuardado(errores);
    }
  };

  $.ajax($.extend({}, opciones, self.opciones.eliminar));
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

CRUDRecurso.prototype.agregarAccionPersonalizada = function(nombre, closure, glyphicon) {
  this.accionesPersonalizadas[nombre] = [closure, glyphicon];
};

CRUDRecurso.prototype.agregarAtributoGenerado = function(nombre, closure) {
  this.atributosGenerados[nombre] = closure;
}
