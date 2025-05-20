@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detalles del Cliente</h1>

    <div class="card">
        <div class="card-body">
            <h2>Información del Cliente</h2>
            <p><strong>Codigo:</strong> {{ $cliente->codigo }}</p>

            <h2>Información Personal</h2>
            <p><strong>Carnet:</strong> {{ $cliente->persona->carnet }}</p>
            <p><strong>Nombre:</strong> {{ $cliente->persona->nombre }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->persona->telefono }}</p>
        </div>
    </div>

    <a href="{{ route('admin.clientes.index') }}" class="btn btn-primary mt-3">Volver a la lista</a>
</div>
@endsection
