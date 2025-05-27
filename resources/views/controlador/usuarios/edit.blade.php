@extends('layouts.app')

@section('content')

@php
    $rol = strtolower(Auth::user()->rolActivo()->nombre);
@endphp

<div class="container">
    <h1>Editar Usuario</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route($rol.'.usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h2>Información del Usuario</h2>

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route($rol.'.usuarios.panel') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
