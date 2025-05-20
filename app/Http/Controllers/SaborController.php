<?php

namespace App\Http\Controllers;

use App\Models\Sabor;
use Illuminate\Http\Request;

class SaborController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sabores = Sabor::all();

        return view("admin.sabores.index", compact("sabores"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.sabores.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|unique:sabores,codigo',
            'descripcion'=> 'required|string|max:255'
        ]);

        Sabor::create($request->all());

        return redirect()->route('admin.sabores.index')
            ->with('success', 'Sabor creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sabor = Sabor::findOrFail($id);
        
        return view('admin.sabores.show', compact('sabor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sabor = Sabor::findOrFail($id);

        return view('admin.sabores.edit', compact('sabor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sabor = Sabor::findOrFail($id);
        
        $request->validate([
            'codigo' => 'required|string|unique:sabores,codigo',
            'descripcion'=> 'required|string|max:255'
        ]);

        $sabor->update([
            'codigo' => $request->codigo,
            'descripcion'=> $request->descripcion
        ]);

        return redirect()->route('admin.sabores.index')
            ->with('success', 'Sabor acttualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sabor = sabor::findOrFail($id);

        $sabor->visible = false;

        $sabor->save();

        return redirect()->route('admin.saboeres.index')
            ->with('success', 'Tipo eliminado correctamente');
    }
}
