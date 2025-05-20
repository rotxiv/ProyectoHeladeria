@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Rol</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $rol->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Rol</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $rol->nombre) }}" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion', $rol->descripcion) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
