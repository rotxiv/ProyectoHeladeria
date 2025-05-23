@extends('layouts.' . strtolower(Auth::user()->rolActivo()->nombre))

@section('title', 'Editar Tipo de Producto')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Tipo de Producto</h2>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('tipos.update', $tipo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo', $tipo->codigo) }}" required>
                    @error('codigo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion', $tipo->descripcion) }}" required>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tipos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
