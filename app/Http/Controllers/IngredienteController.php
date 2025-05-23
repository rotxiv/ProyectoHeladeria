<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Models\Item;

class IngredienteController extends Controller
{
    public function panel()
    {
        return view('controlador.ingredientes.panel');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingrediente = Ingrediente::all();

        return view("controlador.ingredientes.index", compact("ingrediente"));
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("controlador.ingredientes.create");
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

        return redirect()->route('controlador.ingredientes.index')
            ->with('success','El ingrediente fue almacenado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ingrediente = Ingrediente::where('visible', true)->with('item')->find($id);
        
        if (!$ingrediente) {
            return redirect()->route('controlador.ingredientes.index')
                ->with('error', 'El ingrediente con ID ' . $id . ' no fue encontrado.');
        }

        return view('controlador.ingredientes.show', compact('ingrediente'));
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
        $ingrediente = Ingrediente::findOrFail($id);

        // Actualizar los datos del Item asociado
        $ingrediente->item->update($request->input('item'));

        // Actualizar los datos del Ingrediente
        $ingrediente->update([
            'observacion' => $request->observacion
        ]);

        return redirect()->route('controlador.ingredientes.index')
            ->with('success','El ingrediente fue almacenado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ingrediente = Ingrediente::find($id);

        if (!$ingrediente) {
            return redirect()->route('controlador.ingredientes.index')
                ->with('error','El ingrediente con el id '. $id . ' no fue encontrado');
        }

        // Si el ingrediente existe, proceder con la eliminación
        $ingrediente->update(['visible' => false]);

        return redirect()->route('controlador.ingredientes.index')
            ->with('success','El ingrediente fue eliminado correctamente');
    }
}
