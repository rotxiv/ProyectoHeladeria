<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Models\Item;

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Ingrediente::where('visible', true)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo'=> 'required|string|unique:items,codigo',
            'nombre'=> 'required|string',
            'cantidad'=> 'required|integer',
            'descripcion'=> 'required|string',
            'observacion' => 'nullable|string'
        ]);

        //crear el Item para el ingrediente
        $item = Item::firstOrCreate(
            ['codigo' => $request->codigo],
            ['nombre'=> $request->nombre, 
                     'cantidad' => $request->cantidad, 
                     'descripcion'=> $request->descripcion
                    ]
        );

        // Crear el ingrediente vinculado al item
        $ingrediente = Ingrediente::create([
            'item_id'=> $item->id,
            'observacion' => $request->observacion
        ]);

        return response()->json($ingrediente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ingrediente = Ingrediente::where('visible', true)->with('item')->find($id);
        
        return $ingrediente ? response()->json($ingrediente, 200) : 
            response()->json([
                        'message' => 'Ingrediente no encontrado o inactivo'],404
                    );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'item.codigo' => 'required|unique:items,codigo,' . $request->input('item.id'),
            'item.nombre' => 'required|string',
            'item.descripcion' => 'nullable|string',
            'item.cantidad' => 'required|integer|min:0',
            'observacion' => 'nullable|string',
        ]);

        // Obtener el ingrediente
        $ingrediente = Ingrediente::findOrFail($id);

        // Actualizar los datos del Item asociado
        $ingrediente->item->update($request->input('item'));

        // Actualizar los datos del Ingrediente
        $ingrediente->update([
            'observacion' => $request->observacion
        ]);

        return response()->json([
            'message' => 'El ingrediente fue actualizado correctamente',
            'ingrediente' => $ingrediente,
            'item' => $ingrediente->item
            ], 
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ingrediente = Ingrediente::find($id);

        if (!$ingrediente) {
            return response()->json(
                ['message' => 'Ingrediente no encontrado'], 
                404
            );
        }

        $ingrediente->update(['visible' => false]);

        return response()->json(
            ['message' => 'Ingrediente eliminado'], 
            200
        );
    }
}
