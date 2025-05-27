<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Rol;


class UserController extends Controller
{
    public function panel()
    {
        return view('controlador.usuarios.panel');
    }

    public function index()
    {
        // Cargamos la relación hasta persona para mostrar el nombre
        $usuarios = User::with('empleado.persona')->where('visible', true)->get();
        
        return view('controlador.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        // Empleados que aún no tienen un usuario asignado        
        $empleados = Empleado::where('visible', true)
            ->whereDoesntHave('user')
            ->with('persona')
            ->get();

        //obtener la lista de roles para enviarselo a la vista create
        $roles = Rol::all();

        return view('controlador.usuarios.create', compact('empleados','roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id|unique:users,empleado_id',
            'rol_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'empleado_id' => $request->empleado_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            //Hash::make($request->password),
        ]);

        $user->roles()->attach($request->rol_id, ['fecha_asignacion' => now()]);

        return view('controlador.usuarios.panel');

        /* return redirect()->route('controlador.usuarios.index')->with('success', 'Usuario creado correctamente.'); */
    }

    public function show($id)
    {
        $usuario = User::with('empleado.persona')->findOrFail($id);
        
        return view('controlador.usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::with('empleado.persona')->findOrFail($id);

        return view('controlador.usuarios.edit', compact('usuario'));
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
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        return redirect()->route('controlador.usuarios.index')
            ->with('success', 'Usuario actualizado.');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        $usuario->visible = false;
        
        $usuario->save();

        return redirect()->route('controlador.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
