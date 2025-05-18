@extends('layouts.admin')

@section('title', 'Empleados')

@section('content')
    <h2>Listado de Empleados</h2>

    <a href="{{ route('admin.empleados.create') }}" class="button">Crear nuevo empleado</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Carnet</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id }}</td>
                    <td>{{ $empleado->persona->nombre ?? 'Sin datos' }}</td>
                    <td>{{ $empleado->persona->carnet ?? '-' }}</td>
                    <td>{{ $empleado->persona->telefono ?? '-' }}</td>
                    <td>{{ $empleado->direccion }}</td>
                    <td>
                        <a href="{{ route('admin.empleados.edit', $empleado->id) }}">Editar</a> |
                        <form action="{{ route('admin.empleados.destroy', $empleado->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar este empleado?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

