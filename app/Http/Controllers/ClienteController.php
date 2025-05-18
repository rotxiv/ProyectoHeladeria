<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Persona;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('persona')->where('visible', true)->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    public function create()
    {
        $personasDisponibles = Persona::whereDoesntHave('cliente')->get();
        return view('admin.clientes.create', compact('personasDisponibles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'carnet' => 'required|string|max:20|unique:personas,carnet',
            'telefono' => 'nullable|string|max:20',
            'codigo' => 'required|string|unique:clientes,codigo',
        ]);

        // Crear persona
        $persona = Persona::create([
            'nombre' => $request->nombre,
            'carnet' => $request->carnet,
            'telefono' => $request->telefono
        ]);

        // Crear cliente
        Cliente::create([
            'persona_id' => $persona->id,
            'codigo' => $request->codigo,
        ]);

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Cliente creado correctamente.');
    }

    public function show($id)
    {
        $cliente = Cliente::with('persona')->findOrFail($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::with('persona')->findOrFail($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'codigo' => 'required|string|max:100|unique:clientes,codigo,' . $cliente->id,
        ]);

        $cliente->update([
            'codigo' => $request->codigo,
        ]);

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente actualizado.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->visible = false;
        $cliente->save();

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente eliminado (ocultado) correctamente.');
    }
}
