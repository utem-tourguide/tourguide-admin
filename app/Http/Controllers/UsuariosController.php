<?php

namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;
use Input;
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
        $usuario = new Usuario;
        $datos = ['usuario' => $usuario];
        return view('usuarios.create', $datos);
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

        return redirect()->route('usuarios.index')->with('mensaje', 'Usuario Creado');
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
        $datos = ['usuario' => $user];
        return view('usuarios.edit', $datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = Usuario::findOrFail($id);
        $user->update(
            array('nombre' => Input::get('nombre'), 
                  'apellido' => Input::get('apellido'), 
                  'email' => Input::get('email'),
                  'contraseña' => Input::get('contraseña'),
                  'idioma' => Input::get('idioma'))
        );     
        $user->save();
        
        return redirect()->route('usuarios.index')->with('mensaje', 'Usuario Modificado');
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
