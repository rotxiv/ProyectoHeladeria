@extends('layouts.' . strtolower(Auth::user()->rolActivo()->nombre))

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4 text-success">Registrar Nuevo Cliente</h1>

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

    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <h2 class="text-primary">Datos Personales</h2>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" name="nombre" class="form-control border-primary" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="carnet" class="form-label fw-bold">Carnet</label>
                        <input type="text" name="carnet" class="form-control border-primary" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label fw-bold">Teléfono</label>
                    <input type="text" name="telefono" class="form-control border-primary">
                </div>

                <h2 class="text-info mt-4">Datos del Empleado</h2>
                <div class="mb-3">
                    <label for="codigo" class="form-label fw-bold">Codigo</label>
                    <input type="text" name="codigo" class="form-control border-info" required>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-user-plus"></i> Registrar
                    </button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary btn-lg">
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
    .alert-danger {
        padding: 15px;
        border-radius: 5px;
    }
    .btn-success:hover {
        background-color: #28a745;
    }
</style>
@endsection


