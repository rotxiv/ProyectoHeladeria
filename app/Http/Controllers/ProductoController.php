<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Item;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();

        return view("admin.productos.index", compact("productos"));
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.productos.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo'=> 'required|string|unique:items,codigo',
            'nombre'=> 'required|string|max:50',
            'cantidad'=> 'required|integer|min:0',
            'descripcion'=> 'required|string|max:255',
            'observacion' => 'nullable|string'
        ]);

        //crear el Item para el ingrediente
        $item = Item::firstOrCreate(
            ['codigo' => $request->codigo],
            [
                'nombre'=> $request->nombre, 
                'cantidad' => $request->cantidad, 
                'descripcion'=> $request->descripcion
            ]
        );

        // Crear el ingrediente vinculado al item
        $producto = Producto::create([
            'item_id'=> $item->id,
            'observacion' => $request->observacion
        ]);

        return redirect()->route('admin.productos.index')
            ->with('success','El producto fue almacenado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return redirect()->route('admin.productos.index')
                ->with('error','El producto no fue encontrado');
        }

        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return redirect()->route('admin.producto.index')
                ->with('error', 'El producto con ID ' . $id . ' no fue encontrado.');
        }
        return view('admin.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'item.codigo' => 'required|unique:items,codigo,' . $request->input('item.id'),
            'item.nombre' => 'required|string',
            'item.descripcion' => 'nullable|string',
            'item.cantidad' => 'required|integer|min:0',
            'observacion' => 'nullable|string',
        ]);

        // Obtener el ingrediente
        $producto = Producto::findOrFail($id);

        // Actualizar los datos del Item asociado
        $producto->item->update($request->input('item'));

        // Actualizar los datos del Ingrediente
        $producto->update([
            'observacion' => $request->observacion
        ]);

        return redirect()->route('admin.producto.index')
            ->with('success','El producto fue actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return redirect()->route('admin.productos.index')
                ->with('error','El producto con el id '. $id . ' no fue encontrado');
        }

        // Si el ingrediente existe, proceder con la eliminación
        $producto->update(['visible' => false]);

        return redirect()->route('admin.productos.index')
            ->with('success','El producto fue eliminado correctamente');
    }
}
