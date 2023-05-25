<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividades = Actividad::all();
        $data = json_encode([
            'data' => $actividades
        ]);
        return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $actividad = new Actividad();
        $actividad->descripcion = $request->input('descripcion');
        $actividad->nota = $request->input('nota');
        $actividad->codigo_estudiante = $request->input('codigo_estudiante');
        $actividad->save();
        return response(json_encode([
            "data"=>"Usuario registrado"
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividad = Actividad::find($id);

        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }

        $data = [
            'data' => $actividad
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $actividad = Actividad::find($id);
        $actividad->descripcion = $request->input('descripcion');
        $actividad->nota = $request->input('nota');
        $actividad->codigo_estudiante = $request->input('codigo_estudiante');
        $actividad->save();

        return response(json_encode([
            "data"=> "Registro actualizado"
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = Actividad::find($id);

        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }

        $actividad->delete();

        $data = [
            'message' => 'Actividad eliminada exitosamente'
        ];
        return response()->json($data, 200);
    }
}