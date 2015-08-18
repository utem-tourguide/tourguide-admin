@extends('layouts.admin')

@section('title', 'Administrar usuarios')

@section('content')
  <h1>Administrar usuarios</h1>

  <div class="well well-sm">
    <button id="nuevoUsuario" class="btn btn-primary btn-sm">Nuevo usuario</button>
  </div>

  <table id="usuarios" class="table table-striped table-hover" hidden>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Idioma</th>
      <th>Email</th>
      <th>Rol</th>
      <th>Creado en</th>
      <th>Modificado en</th>
      <th>Acciones</th>
    </tr>
  </table>
@endsection

@section('scripts')
  @parent
  <script>
    var atributos = ['id',
                     'nombre',
                     'apellido',
                     'idioma',
                     'email',
                     'rol',
                     'created_at',
                     'updated_at'];
    var crud = new CRUDRecurso('usuario',
                               '{{ route('usuarios.index') }}',
                               $('#usuarios'),
                               atributos);

    crud.cargarTabla();

    $('#nuevoUsuario').on('click', function() { crud.mostrarDialogoNuevo() });
  </script>
@endsection
