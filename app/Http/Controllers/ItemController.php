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
        $items = Item::all();

        return view("admin.items.index", compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.items.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:items',
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'descripcion' => 'required|string|max:255'
        ]);

        $item = Item::create($request->all());

        return redirect()->route('admin.items.index')
            ->with('success','Item almacenado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('admin.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);

        return view('admin.unidades.edit', compact('unidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'codigo' => 'string|unique:items,codigo,' . $id,
            'nombre' => 'required',
            'cantidad' => 'integer',
        ]);

        $item->update([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->route('admin.items.index')
            ->with('success','El item ha sido actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar el item en la base de datos
        $item = Item::find($id);

        // Si el item no existe, redirigir con un mensaje de error
        if (!$item) {
            return redirect()->route('admin.items.index')
                ->with('error', 'El item con ID ' . $id . ' no fue encontrado.');
        }

        // Si el item existe, proceder con la eliminación
        $item->visible = false;

        $item->save();

        return redirect()->route('items.index')
            ->with('success', 'Item eliminado correctamente.');
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
