@extends('layouts.app')

@section('content')

@php
    $rol = strtolower(Auth::user()->rolActivo()->nombre);
@endphp

<div class="container mt-4">
    <h1 class="text-center mb-4 text-primary">Editar Empleado</h1>

    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ route($rol.'.empleados.update', $empleado->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h2 class="text-success">Información del Empleado</h2>
                <div class="mb-3">
                    <label for="direccion" class="form-label fw-bold">Dirección</label>
                    <input type="text" name="empleado[direccion]" class="form-control border-primary" value="{{ old('empleado.direccion', $empleado->direccion) }}">
                </div>

                <h2 class="text-info mt-4">Información Personal</h2>
                <div class="mb-3">
                    <label for="carnet" class="form-label fw-bold">Carnet</label>
                    <input type="text" name="persona[carnet]" class="form-control border-info" value="{{ old('persona.carnet', $empleado->persona->carnet) }}">
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input type="text" name="persona[nombre]" class="form-control border-info" value="{{ old('persona.nombre', $empleado->persona->nombre) }}">
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label fw-bold">Teléfono</label>
                    <input type="text" name="persona[telefono]" class="form-control border-info" value="{{ old('persona.telefono', $empleado->persona->telefono) }}">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
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
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .form-control {
        border-width: 2px;
        padding: 10px;
    }
    .btn-lg {
        padding: 10px 20px;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endsection

