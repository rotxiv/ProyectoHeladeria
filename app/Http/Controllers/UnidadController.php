<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    public function panel()
    {
        return view('controlador.unidades.panel');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades = Unidad::all();

        return view("controlador.unidades.index", compact("unidades"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("controlador.unidades.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'simbolo' => 'required|string|unique:unidades,simbolo',
            'descripcion'=> 'required|string|max:255'
        ]);
        
        Unidad::create($request->all());

        return redirect()->route('controlador.unidades.index')
            ->with('success','Unidad de medida guardada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $unidad = Unidad::where('visible', true)->find($id);

        return view('controlador.unidades.show', compact('unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unidad = Unidad::findOrFail($id);

        return view('controlador.unidades.edit', compact('unidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $unidad = Unidad::findOrFail($id);

        $request->validate([
            'simbolo' => 'required|string|unique:unidades,simbolo',
            'descripcion'=> 'required|string|max:255'
        ]);

        $unidad->update([
            'codigo' => $request->codigo,
            'descripcion'=> $request->descripcion
        ]);

        return redirect()->route('controlador.unidades.index')
            ->with('success','Unidad de medida guardada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unidad = Unidad::find($id);

        if (!$unidad) {
            return redirect()->route('controlador.items.index')
                ->with('error', 'El item con ID ' . $id . ' no fue encontrado.');
        }

        $unidad->visible = false;

        $unidad->save();

        return redirect()->route('controlador.tipos.index')
            ->with('success', 'Unidad de medida eliminado correctamente');
    }
}
