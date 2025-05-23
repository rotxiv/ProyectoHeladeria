@extends('layouts.generico')

@section('title', 'Panel de Administrador')

@section('sidebar')
    <h4>Administrar Personas</h4>
    <div class="submenu">
        <a href="{{ route('empleados.panel') }}">Gestionar empleados</a>
        <a href="{{ route('clientes.panel') }}">Gestionar clientes</a>
        <a href="{{ route('roles.panel') }}">Gestionar roles</a>
        <a href="{{ route('usuarios.panel') }}">Gestionar usuarios</a>
    </div>

    <h4>Administrar Cocina</h4>
    <div class="submenu">
        <a href="{{ route('productos.panel') }}">Gestionar productos</a>
        <a href="{{ route('ingredientes.panel') }}">Gestionar ingredientes</a>
        <a href="{{ route('sabores.panel') }}">Gestionar sabores</a>
        <a href="{{ route('tipos.panel') }}">Gestionar tipos de productos</a>
        <a href="{{ route('unidades.panel') }}">Gestionar unidades de medida</a>
    </div>
@endsection

@section('content')
    <p>Bienvenido al panel del administrador. Selecciona una opción del menú para comenzar.</p>
@endsection

@push('styles')
<style>
    .sidebar h4 {
        color: #bdc3c7;
        font-size: 14px;
        padding: 10px 20px 5px;
        margin: 0;
    }

    .submenu {
        margin-left: 10px;
        padding-left: 10px;
        border-left: 2px solid #7f8c8d;
    }

    .submenu a {
        display: block;
        padding: 6px 20px;
        font-size: 15px;
        color: #ecf0f1;
        text-decoration: none;
    }

    .submenu a:hover {
        background-color: #3d566e;
    }
</style>
@endpush


