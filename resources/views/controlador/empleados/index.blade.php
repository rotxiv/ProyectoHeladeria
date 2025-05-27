@extends('layouts.app')

@section('title', 'Empleados')

@section('content')

@php
    $rol = strtolower(Auth::user()->rolActivo()->nombre);
@endphp

<div class="container">
    <h2 class="page-title">Listado de Empleados</h2>

    <div class="actions">
        <a href="{{ route($rol.'.empleados.create') }}" class="btn green">
            &#x2795; Crear nuevo empleado
        </a>
    </div>

    <div class="card">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Carnet</th>
                    <th>Cargo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->persona->nombre ?? 'Sin datos' }}</td>
                        <td>{{ $empleado->persona->carnet ?? '-' }}</td>
                        <td>{{ $empleado->cargo ?? '-' }}</td>                        
                         <td>
                            <a href="{{ route($rol.'.empleados.show', $empleado->id) }}" class="btn blue">Ver</a>
                            <a href="{{ route($rol.'.empleados.edit', $empleado->id) }}" class="btn orange">Editar</a>
                            <form action="{{ route($rol.'.empleados.destroy', $empleado->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn red" onclick="return confirm('¿Eliminar este empleado?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .container {
        transform: translateX(50px);
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
    }

    .page-title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        color: #333;
    }

    .actions {
        text-align: right;
        margin-bottom: 15px;
    }

    .btn {
        display: inline-block;
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
    }

    .btn.green { background-color: #28a745; }
    .btn.blue { background-color: #007bff; }
    .btn.orange { background-color: #fd7e14; }
    .btn.red { background-color: #dc3545; }

    .card {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th, .custom-table td {
        padding: 12px 10px;
        text-align: center;
        border-bottom: 1px solid #ccc;
    }

    .custom-table th {
        background-color: #343a40;
        color: white;
    }

    .custom-table tr:hover {
        background-color: #f1f1f1;
    }

    form {
        display: inline;
    }

    .btn + .btn {
        margin-left: 5px;
    }
</style>
@endsection
