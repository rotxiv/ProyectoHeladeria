@extends('layouts.app')

@section('content')

@php
    $rol = strtolower(Auth::user()->rolActivo()->nombre);
@endphp

<div class="container">
    <h1>Detalles del Usuario</h1>

    <div class="card">
        <div class="card-body">
            <h2>Información del Usuario</h2>
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>

            <h2>Información del Empleado Asociado</h2>
            @if($user->empleado && $user->empleado->persona)
                <p><strong>Nombre del Empleado:</strong> {{ $user->empleado->persona->nombre }}</p>
            @else
                <p class="text-muted">No hay un empleado asociado a este usuario.</p>
            @endif
        </div>
    </div>

    <a href="{{ route($rol.'.usuarios.panel') }}" class="btn btn-primary mt-3">Volver</a>
</div>
@endsection

