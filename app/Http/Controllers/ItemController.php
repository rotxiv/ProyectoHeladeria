<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Item::where('visible', true)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:items',
            'nombre' => 'required',
            'cantidad' => 'required|integer',
            'descripcion' => 'require'
            //'visible' => 'boolean'
        ]);

        $item = Item::create($request->all());

        return response()->json($item, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::where('visible', true)->find($id);

        return $item ? response()->json($item, 200) : 
            response()->json(['message' => ' no encontrado o inactivo'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::where('visible', true)->find($id);

        $request->validate([
            'codigo' => 'string|unique:items,codigo,' . $id,
            'nombre' => 'required',
            'cantidad' => 'integer',
        ]);

        $item->update($request->all());
        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(
                ['message' => 'Item no encontrado'], 
                404
            );
        }

        $item->update(['visible' => false]);

        return response()->json(['message' => 'Item eliminado'], 200);
    }

    // Listar items desactivados
    public function inactivos()
    {
        return response()->json(
            Item::where('visible', false)->get(), 
            200
        );
    }

    public function reactivar($id)
    {
        $item = Item::where('visible', false)->find($id);

        if (!$item) {
            return response()->json(
                ['message' => 'Item no encontrado o ya activo'], 
                404
            );
        }

        $item->update(['visible' => true]);

        return response()->json(
            ['message' => 'Item reactivado', 'item' => $item], 
            200
        );
    }
}
