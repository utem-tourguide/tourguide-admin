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
    public function create() {
        return view('ubicaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        return UbicacionTuristica::create(Input::all());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return UbicacionTuristica::find($id) ?: error_404();
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
        $ubicacion = UbicacionTuristica::find($id);
        $ubicacion -> update( array('nombre' => Input::get('nombre'), 'localizacion'=> Input::get('localizacion')));
        $ubicacion -> save();
        return $ubicacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $ubicacion = User::find($id);
        
        if (is_null ($ubicacion))
        {
            App::abort(404);
        }
        
        $ubicacion->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'ubicacion ' . $ubicacion->full_name . ' eliminado',
                'id'      => $ubicacion->id
            ));
        }
        else
        {
            return Redirect::route('administrar.ubicaciones.index');
        }
    }

}
