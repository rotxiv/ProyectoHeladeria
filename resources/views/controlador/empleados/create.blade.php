@extends('layouts.app')

@section('content')

@php
    $rol = strtolower(Auth::user()->rolActivo()->nombre);
@endphp

<div class="container mt-4" style="margin-left: 270px; max-width: 900px;"> {{-- Ajusta el margen izquierdo para evitar superposición --}}
    <h1 class="text-center mb-4 text-success">Registrar Nuevo Empleado</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Errores encontrados:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg custom-card">
        <div class="card-body">
            <form action="{{ route(name: $rol.'.empleados.store') }}" method="POST">
                @csrf

                <h2 class="section-title text-primary">Datos Personales</h2>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" name="nombre" class="form-control styled-input" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="carnet" class="form-label fw-bold">Carnet</label>
                        <input type="text" name="carnet" class="form-control styled-input" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label fw-bold">Teléfono</label>
                    <input type="text" name="telefono" class="form-control styled-input">
                </div>

                <h2 class="section-title text-info mt-4">Datos del Empleado</h2>
                <div class="mb-3">
                    <label for="direccion" class="form-label fw-bold">Dirección</label>
                    <input type="text" name="direccion" class="form-control styled-input" required>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg me-2">
                        <i class="fas fa-user-plus"></i> Registrar
                    </button>
                    <a href="{{ route($rol.'.empleados.panel') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-card {
        border-radius: 12px;
        padding: 30px;
        background-color: #f8f9fa;
    }

    .styled-input {
        border: 2px solid #17a2b8;
        border-radius: 8px;
        transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .styled-input:focus {
        border-color: #138496;
        box-shadow: 0 0 5px rgba(19, 132, 150, 0.5);
    }

    .section-title {
        font-size: 1.5rem;
        margin-bottom: 20px;
        border-bottom: 2px solid #ccc;
        padding-bottom: 10px;
    }

    .btn-lg {
        padding: 10px 25px;
        font-size: 1.1rem;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-secondary:hover {
        background-color: #6c757d;
        border-color: #5a6268;
    }

    .alert-danger {
        padding: 15px;
        border-radius: 6px;
        background-color: #f8d7da;
        border-left: 6px solid #dc3545;
    }

    @media (max-width: 768px) {
        .container {
            margin-left: 0 !important;
        }
    }
</style>
@endsection

