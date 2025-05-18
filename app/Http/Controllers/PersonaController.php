<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Persona::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'carnet' => 'required|string|unique:personas,carnet',
            'nombre' => 'required|string',
            'telefono' => 'required|string',
        ]);

        $persona = Persona::create($request->all());

        return response()->json($persona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json([
                'message' => 'Persona no encontrada'], 
                404
            );
        }

        return response()->json($persona, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json([
                'message' => 'Persona no encontrada'], 
                404
            );
        }

        $request->validate([
            'carnet' => 'string|unique:personas,carnet,' . $id,
            'nombre' => 'string',
            'telefono' => 'string',
        ]);

        $persona->update($request->all());

        return response()->json($persona, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $persona = Persona::find($id);

        if (!$persona) {
            return response()->json([
                'message' => 'Persona no encontrada'], 
                404
            );
        }

        $persona->delete();

        return response()->json([
            'message' => 'Persona eliminada'], 
            200
        );
    }
}
