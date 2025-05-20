<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Cargamos la relación hasta persona para mostrar el nombre
        $usuarios = User::with('empleado.persona')->where('visible', true)->get();
        
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        // Empleados que aún no tienen un usuario asignado        
        $empleados = Empleado::where('visible', true)
            ->whereDoesntHave('user')
            ->with('persona')
            ->get();

        return view('admin.usuarios.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id|unique:users,empleado_id',
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'empleado_id' => $request->empleado_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function show($id)
    {
        $usuario = User::with('empleado.persona')->findOrFail($id);
        
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::with('empleado.persona')->findOrFail($id);

        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado.');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        $usuario->visible = false;
        
        $usuario->save();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
