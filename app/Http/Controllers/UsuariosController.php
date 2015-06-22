<?php

namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;

use TourGuide\Http\Requests;
use TourGuide\Models\Usuario;
use TourGuide\Http\Controllers\Controller;

class UsuariosController extends Controller {
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
    public function store()
    {
        //
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
        //
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
    public function destroy($id)
    {
        //
    }
}
