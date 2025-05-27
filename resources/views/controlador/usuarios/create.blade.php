@extends('layouts.app')

@section('content')

@php
    $rol = strtolower(Auth::user()->rolActivo()->nombre);
@endphp

<div class="container mt-5" style="margin-left: 270px; max-width: 700px;">
    <h2 class="text-center text-primary mb-4">Registrar Nuevo Usuario</h2>

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

    <div class="card shadow custom-card">
        <div class="card-body">
            <form action="{{ route($rol.'.usuarios.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="empleado_id" class="form-label fw-bold">Empleado</label>
                    <select name="empleado_id" id="empleado_id" class="form-select styled-input" required>
                        <option value="">Seleccione un empleado</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}">{{ $empleado->persona->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="rol_id" class="form-label fw-bold">Rol</label>
                    <select name="rol_id" id="rol_id" class="form-select styled-input" required>
                        <option value="">Seleccione un rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nombre de usuario</label>
                    <input type="text" name="name" id="name" class="form-control styled-input" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Correo</label>
                    <input type="email" name="email" id="email" class="form-control styled-input" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control styled-input" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-bold">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control styled-input" required>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg me-2">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <a href="{{ route($rol.'.usuarios.panel') }}" class="btn btn-secondary btn-lg">
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
