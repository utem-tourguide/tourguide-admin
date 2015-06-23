<?php

namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;

use TourGuide\Http\Requests;
use TourGuide\Models\Usuario;
use TourGuide\Http\Controllers\Controller;

class UsuariosController extends Controller {

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
        $datos = [
          'usuarios' => Usuario::paginate(15)
        ];
        return view('usuarios.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $usuario = new Usuario($request->only($this->atributos_de_usuario));
        $usuario->rol_id = $request->get('rol_id');
        $usuario->save();

        return view('usuarios.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = Usuario::findOrFail($id);
        return view('usuarios.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $usuario = Usuario::find($id);
        $usuario->delete();

        $datos = [
            'usuario' => $usuario
        ];
        return view('usuarios.destroy', $datos);
    }
}
