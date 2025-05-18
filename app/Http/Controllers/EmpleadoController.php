<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Persona;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('persona')->where('visible', true)->get();
        return view('admin.empleados.index', compact('empleados'));
    }

    public function create()
    {
        // Solo empleados visibles que no tengan usuario aún
        $empleados = Empleado::where('visible', true)
            ->whereDoesntHave('user')
            ->with('persona')
            ->get();

        return view('admin.usuarios.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);

        // Crear persona
        $persona = Persona::create([
            'nombre' => $request->nombre,
            'carnet' => $request->carnet,
            'telefono' => $request->telefono,
        ]);

        // Crear empleado
        Empleado::create([
            'persona_id' => $persona->id,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('admin.empleados.index')
            ->with('success', 'Empleado creado correctamente.');
    }

    public function show($id)
    {
        $empleado = Empleado::with('persona')->findOrFail($id);
        return view('admin.empleados.show', compact('empleado'));
    }

    public function edit($id)
    {
        $empleado = Empleado::with('persona')->findOrFail($id);
        return view('admin.empleados.edit', compact('empleado'));
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'direccion' => 'required|string|max:255',
        ]);

        $empleado->update([
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('admin.empleados.index')->with('success', 'Empleado actualizado.');
    }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->visible = false;
        $empleado->save();

        return redirect()->route('admin.empleados.index')->with('success', 'Empleado eliminado (ocultado) correctamente.');
    }

}
