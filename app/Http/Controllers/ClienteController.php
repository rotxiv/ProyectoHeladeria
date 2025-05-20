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
        return view('admin.clientes.create');
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
        // Validar los datos del formulario
        $request->validate([
            'persona.carnet' => 'required|unique:personas,carnet,' . $request->input('persona.id'),
            'persona.nombre' => 'required|string|max:50',
            'persona.telefono' => 'required|string|max:20',
            'empleado.direccion' => 'required|string|max:100'
        ]);

        // Obtener el empleado
        $cliente = Cliente::findOrFail($id);

        // Actualizar los datos de la Persona asociada
        $cliente->persona->update($request->input('persona'));

        // Actualizar los datos del Empleado
        $cliente->update([
            'direccion' => $request->input('empleado.direccion')
        ]);

        return redirect()->route('admin.clientes.index')
            ->with('success', 'El cliente fue actualizado correctamente.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->visible = false;
        $cliente->save();

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente eliminado (ocultado) correctamente.');
    }
}
