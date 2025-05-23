<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Persona;

class EmpleadoController extends Controller
{
    public function panel()
    {
        return view('controlador.empleados.panel');
    }

    public function index()
    {
        $empleados = Empleado::with('persona')
            ->where('visible', true)->get();
        
        return view('controlador.empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('controlador.empleados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'carnet'=> 'required|string|max:20|unique:personas,carnet',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'required|string|max:255'
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

        return view(
            'controlador.empleados.panel', 
            ['error' => 'El empleado el empleado fue añadido con exito']
        );
         //redirect()->route('controlador.empleados.index')
            //->with('success', 'Empleado creado correctamente.');
    }

    public function show($id)
    {
        //$empleado = Empleado::with('persona')->findOrFail($id);
        $empleado = Empleado::where('visible', true)
            ->with('persona')->find($id);

        if (!$empleado) {
            return view(
                'controlador.empleados.panel', 
                ['error' => 'El empleado con el ID ' . $id . ' no fue encontrado']
            );
        }

        return view('controlador.empleados.show', compact('empleado'));
    }

    public function edit($id)
    {
        $empleado = Empleado::with('persona')->findOrFail($id);

        return view('controlador.empleados.edit', compact('empleado'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'persona.carnet' => 'required|unique:personas,carnet,' . $request->input('persona.id'),
            'persona.nombre' => 'required|string',
            'persona.telefono' => 'nullable|string',
            'empleado.direccion' => 'nullable|string',
        ]);

        // Obtener el empleado
        $empleado = Empleado::findOrFail($id);

        // Actualizar los datos de la Persona asociada
        $empleado->persona->update($request->input('persona'));

        // Actualizar los datos del Empleado
        $empleado->update([
            'direccion' => $request->input('empleado.direccion')
        ]);

        return redirect()->route('controlador.empleados.index')
            ->with('success', 'El empleado fue actualizado correctamente.');
    }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);

        if (!$empleado) {
            return redirect()->route('empleados.index')
                ->with('error','El empleado con el id '. $id . ' no fue encontrado');
        }

        $empleado->visible = false;
        
        $empleado->save();

        return redirect()->route('controlador.empleados.index')
            ->with('success', 'El empleado eliminado correctamente.');
    }

    public function showByCarnet($carnet)
    {
        $empleado = Empleado::where('carnet', $carnet)
                        ->where('visible', true)
                        ->with('persona')
                        ->firstOrFail();

        if (!$empleado) {
            return view(
                'controlador.empleados.panel', 
                ['error' => 'El empleado con el Carnet ' . $carnet . ' no fue encontrado']
            );
        }

        return view('controlador.empleados.show', compact('empleado'));
    }
}
