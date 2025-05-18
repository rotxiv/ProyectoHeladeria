@extends('layouts.admin')

@section('title', 'Clientes')

@section('content')
    <h2>Listado de Clientes</h2>

    <a href="{{ route('admin.clientes.create') }}" class="button">Registrar nuevo cliente</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Carnet</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->codigo }}</td>
                    <td>{{ $cliente->persona->nombre ?? 'Sin datos' }}</td>
                    <td>{{ $cliente->persona->carnet ?? '-' }}</td>
                    <td>{{ $cliente->persona->telefono ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.clientes.edit', $cliente->id) }}">Editar</a> |
                        <form action="{{ route('admin.clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar este cliente?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

