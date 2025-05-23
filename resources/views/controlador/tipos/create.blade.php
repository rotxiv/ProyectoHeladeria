@extends('layouts.' . strtolower(Auth::user()->rolActivo()->nombre))

@section('title', 'Crear Tipo de Producto')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Nuevo Tipo de Producto</h2>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('tipos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo') }}" required>
                    @error('codigo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion') }}" required>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('tipos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
