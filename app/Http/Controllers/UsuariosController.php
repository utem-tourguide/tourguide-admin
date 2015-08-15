<?php namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Input;
use TourGuide\Http\Requests;
use TourGuide\Models\Usuario;
use TourGuide\Http\Controllers\Controller;

class UsuariosController extends RecursoController {

  private $atributos_de_usuario = ['email',
                                   'contrasena',
                                   'nombre',
                                   'apellido',
                                   'idioma'];

  /**
   * Muestra una lista de usuarios registrados en TourGuide.
   *
   * @return Response
   */
  public function index() {
    return Usuario::all();
  }

  /**
   * Muestra el formulario para crear un nuevo usuario.
   *
   * @return Response
   */
  public function create() {
    return view('usuarios.create');
  }

  /**
   * Muestra el formulario para editar un usuario registrado.
   *
   * @param  int $id
   *
   * @return Response
   */
  public function edit($id) {
    $datos = ['usuario' => Usuario::find($id)];

    return view('usuarios.create', $datos);
  }

  /**
   * Almacena un nuevo usuario en la base de datos.
   *
   * @param  \Illuminate\Http\Request $peticion
   * @return Response
   */
  public function store(Request $peticion) {
    $usuario = new Usuario($peticion->only($this->atributos_de_usuario));
    $usuario->rol_id = $peticion->get('rol_id');
    $usuario->save();

    return $usuario;
  }

  /**
   * Muestra un usuario específico.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id) {
    return Usuario::find($id) ?: error_404();
  }

  /**
   * Actualiza el usuario específicado en la base de datos.
   *
   * @param Request $peticion
   * @param int     $id
   *
   * @return Response
   */
  public function update(Request $peticion, $id) {
    $usuario = Usuario::find($id);
    $usuario->rol_id = $peticion->get('rol_id');
    $usuario->update($peticion->except(['rol_id', '_token']));

    return $usuario;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function destroy($id) {
    $usuario = Usuario::find($id);
    if ($usuario) {
      $usuario->delete();
    } else {
      return error_404();
    }
  }

}
