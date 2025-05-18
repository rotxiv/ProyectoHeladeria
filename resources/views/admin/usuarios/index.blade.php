@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
    <h2>Listado de Usuarios</h2>

    <a href="{{ route('admin.usuarios.create') }}" class="button">Crear nuevo usuario</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Email</th>
                <th>Empleado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        {{ $usuario->empleado->persona->nombre ?? 'Sin empleado' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.usuarios.edit', $usuario->id) }}">Editar</a> |
                        <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Deseas eliminar este usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
