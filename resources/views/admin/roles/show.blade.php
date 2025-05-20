@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detalles del Rol</h1>

    <div class="card">
        <div class="card-body">
            <h2>Información del Rol</h2>
            <p><strong>ID:</strong> {{ $rol->id }}</p>
            <p><strong>Nombre:</strong> {{ $rol->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $rol->descripcion }}</p>
        </div>
    </div>

    <a href="{{ route('admin.roles.index') }}" class="btn btn-primary mt-3">Volver a la lista</a>
</div>
@endsection
