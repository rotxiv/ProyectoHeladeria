@extends('layouts.' . strtolower(Auth::user()->rolActivo()->nombre))

@section('title', 'Tipos de Sabores')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Listado de Tipos de Sabores</h2>

    <div class="text-end mb-3">
        <a href="{{ route('cocina.tipos-producto.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Tipo de Sabor
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            @if($tipos->isEmpty())
                <p class="text-center text-muted">No hay tipos de sabores registrados.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($tipos as $tipo)
                            <tr>
                                <td>{{ $tipo->codigo }}</td>
                                <td>{{ $tipo->descripcion }}</td>
                                <td>
                                    <a href="{{ route('tipos.edit', $tipo->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('tipos.destroy', $tipo->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este tipo?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
