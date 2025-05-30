@extends('layouts.app')

@section('content')

@php
    $rol = strtolower(Auth::user()->rolActivo()->nombre);
@endphp

<div class="container mt-5" style="margin-left: 270px; max-width: 800px;">
    <h1 class="text-center mb-4 text-primary">Editar Empleado</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Se encontraron errores:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow custom-card">
        <div class="card-body">
            <form action="{{ route($rol.'.empleados.update', $empleado->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h4 class="text-success mb-3">Información del Empleado</h4>
                <div class="mb-3">
                    <label for="direccion" class="form-label fw-bold">Dirección</label>
                    <input type="text" name="empleado[direccion]" id="direccion"
                        class="form-control styled-input"
                        value="{{ old('empleado.direccion', $empleado->direccion) }}" required>
                </div>

                <h4 class="text-info mt-4 mb-3">Información Personal</h4>

                <div class="mb-3">
                    <label for="carnet" class="form-label fw-bold">Carnet</label>
                    <input type="text" name="persona[carnet]" id="carnet"
                        class="form-control styled-input"
                        value="{{ old('persona.carnet', $empleado->persona->carnet) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" name="persona[nombre]" id="nombre"
                        class="form-control styled-input"
                        value="{{ old('persona.nombre', $empleado->persona->nombre) }}" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label fw-bold">Teléfono</label>
                    <input type="text" name="persona[telefono]" id="telefono"
                        class="form-control styled-input"
                        value="{{ old('persona.telefono', $empleado->persona->telefono) }}">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg me-2">
                        <i class="fas fa-save"></i> Guardar cambios
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
        background-color: #fdfdfd;
    }

    .styled-input {
        border: 2px solid #0d6efd;
        border-radius: 8px;
        padding: 10px;
        transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .styled-input:focus {
        border-color: #0b5ed7;
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
    }

    .btn-lg {
        padding: 10px 25px;
        font-size: 1.1rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004b99;
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


