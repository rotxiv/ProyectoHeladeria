@extends('layouts.admin')

@section('title', 'Roles')

@section('content')
    <h2>Listado de Roles</h2>

    <a href="{{ route('admin.roles.create') }}" class="button">Crear nuevo rol</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Rol</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $rol)
                <tr>
                    <td>{{ $rol->id }}</td>
                    <td>{{ $rol->nombre }}</td>
                    <td>{{ $rol->descripcion ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $rol->id) }}">Editar</a> |
                        <form action="{{ route('admin.roles.destroy', $rol->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar este rol?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

