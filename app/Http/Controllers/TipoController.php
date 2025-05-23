<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function panel()
    {
        return view('controlador.tipos.panel');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos = Tipo::all();
        
        return view('controlador.tipos.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('controlador.tipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|unique:tipos,codigo',
            'descripcion'=> 'required|string|max:255'
        ]);

        Tipo::create($request->all());

        return redirect()->route('controlador.tipos.index')
            ->with('success', 'Tipo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tipo = Tipo::findOrFail($id);
        
        return view('controlador.tipos.show', compact('tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipo = Tipo::findOrFail($id);

        return view('controlador.roles.edit', compact('tipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tipo = Tipo::findOrFail($id);
        
        $request->validate([
            'codigo' => 'required|string|unique:tipos,codigo',
            'descripcion'=> 'required|string|max:255'
        ]);

        $tipo->update([
            'codigo' => $request->codigo,
            'descripcion'=> $request->descripcion
        ]);

        return redirect()->route('controlador.tipos.index')
            ->with('success', 'Tipo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);

        $tipo->visible = false;

        $tipo->save();

        return redirect()->route('controlador.tipos.index')
            ->with('success', 'Tipo eliminado correctamente');
    }
}
