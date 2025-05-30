@extends('layouts.app')

@section('title', 'Bitacora')

@section('content')

<div class="container">
    <h2 class="page-title">Registro de Bitácora</h2>

    <div class="actions">
        <a href="{{ route('administrador.bitacoras.panel') }}" class="btn blue">
            &#x2795; Volver al panel principal
        </a>
    </div>

    <div class="card">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>IP</th>
                    <th>Navegador</th>
                    <th>Inicio de sesión</th>
                    <th>Cierre de sesión</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bitacoras as $registro)
                <tr>
                    <td>{{ $registro->id }}</td>
                    <td>{{ $registro->user->name ?? 'Usuario eliminado' }}</td>
                    <td>{{ $registro->ip_address }}</td>
                    <td>{{ Str::limit($registro->user_agent, 50) }}</td>
                    <td>{{ $registro->logged_in_at }}</td>
                    <td>
                        @if ($registro->logged_out_at)
                            {{ $registro->logged_out_at }}
                        @else
                            <span class="text-muted">Sesión activa</span>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay registros en la bitácora.</td>
                    </tr>
                @endforelse
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
    .btn.blue { background-color: #007bff; }

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