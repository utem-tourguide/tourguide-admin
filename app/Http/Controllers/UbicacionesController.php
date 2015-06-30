<?php

namespace TourGuide\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use TourGuide\Http\Requests;
use TourGuide\Models\UbicacionTuristica;
use TourGuide\Http\Controllers\Controller;

class UbicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return UbicacionTuristica::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ubicaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        UbicacionTuristica::create(Input::all());
        return redirect()->route('ubicaciones.index')
                         ->with('mensaje', 'Ubicación guardada.');
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
        $datos = UbicacionTuristica::find($id);
        $ubicaciones = ['ubicaciones' => $datos];
         return view('ubicaciones.edit', $ubicaciones);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $ubicaciones = UbicacionTuristica::find($id);
        $ubicaciones -> update( array('nombre' => Input::get('nombre'), 'localizacion'=> Input::get('localizacion')));
        $ubicaciones -> save();
        return redirect()->route('ubicaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $ubicaciones = UbicacionTuristica::find($id);
        $ubicaciones-> delete();

        $datos = ['Usuarios' => $ubicaciones];

        return redirect()->route('ubicaciones.index')
                         ->with('mensaje', 'Ubicación eliminada.');
    }
}
