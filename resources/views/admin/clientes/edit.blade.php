@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Cliente</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h2>Información del Cliente</h2>

                <div class="mb-3">
                    <label for="codigo" class="form-label">Codigo</label>
                    <input type="text" name="cliente[codigo]" class="form-control" value="{{ old('cliente.codigo', $cliente->codigo) }}">
                </div>

                <h2>Información Personal</h2>

                <div class="mb-3">
                    <label for="carnet" class="form-label">Carnet</label>
                    <input type="text" name="persona[carnet]" class="form-control" value="{{ old('persona.carnet', $cliente->persona->carnet) }}">
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="persona[nombre]" class="form-control" value="{{ old('persona.nombre', $cliente->persona->nombre) }}">
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="persona[telefono]" class="form-control" value="{{ old('persona.telefono', $cliente->persona->telefono) }}">
                </div>

                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
