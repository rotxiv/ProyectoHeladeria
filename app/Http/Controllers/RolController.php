<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    public function panel()
    {
        return view('controlador.roles.panel');
    }

    public function index()
    {
        $roles = Rol::where('visible', true)->get();

        return view('controlador.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('controlador.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:roles,nombre',
            'descripcion' => 'required|string|max:255',
        ]);

        Rol::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('controlador.roles.index')
            ->with('success', 'Rol creado correctamente.');
    }

    public function show($id)
    {
        $rol = Rol::findOrFail($id);

        return view('controlador.roles.show', compact('rol'));
    }

    public function edit($id)
    {
        $rol = Rol::findOrFail($id);
        
        return view('controlador.roles.edit', compact('rol'));
    }

    public function update(Request $request, $id)
    {
        $rol = Rol::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100|unique:roles,nombre,' . $rol->id,
            'descripcion' => 'nullable|string',
        ]);

        $rol->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('controlador.roles.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->visible = false;
        $rol->save();

        return redirect()->route('controlador.roles.index')
            ->with('success', 'Rol eliminado (ocultado) correctamente.');
    }
}
