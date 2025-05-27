@extends('layouts.app')

@section('title', 'Detalle del Empleado')

@section('content')
<div class="container">
    <h2 class="page-title">Detalle del Empleado</h2>

    <div class="card">
        <div class="info-group">
            <label>Nombre:</label>
            <span>{{ $empleado->persona->nombre ?? 'Sin datos' }}</span>
        </div>

        <div class="info-group">
            <label>Carnet:</label>
            <span>{{ $empleado->persona->carnet ?? '-' }}</span>
        </div>

        <div class="info-group">
            <label>Teléfono:</label>
            <span>{{ $empleado->persona->telefono ?? '-' }}</span>
        </div>

        <div class="info-group">
            <label>Dirección:</label>
            <span>{{ $empleado->direccion ?? '-' }}</span>
        </div>

        <div class="info-group">
            <label>Cargo:</label>
            <span>{{ $empleado->cargo ?? '-' }}</span>
        </div>

        <div class="actions">
            <a href="{{ route(name: 'gerente.empleados.panel') }}" class="btn gray">Volver</a>
            <a href="{{ route('gerente.empleados.edit', $empleado->id) }}" class="btn orange">Editar</a>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 700px;
        margin: 40px auto;
        padding: 20px;
    }

    .page-title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 26px;
        color: #333;
    }

    .card {
        background: #fdfdfd;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .info-group {
        margin-bottom: 15px;
    }

    .info-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    .info-group span {
        display: block;
        font-size: 16px;
        color: #222;
        padding-left: 5px;
    }

    .actions {
        margin-top: 25px;
        text-align: right;
    }

    .btn {
        display: inline-block;
        padding: 8px 14px;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
        margin-left: 10px;
    }

    .btn.gray { background-color: #6c757d; }
    .btn.orange { background-color: #fd7e14; }
</style>
@endsection
