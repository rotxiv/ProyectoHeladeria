@extends('layouts.generico')

@section('sidebar')
    <h4 style="color: #bdc3c7; padding: 10px 20px;">Administrar Cocina</h4>
    <div class="submenu" style="display: flex; flex-direction: column; gap: 8px; padding: 0 20px;">
        <a href="{{ route('productos.panel') }}">Gestionar productos</a>
        <a href="{{ route('ingredientes.panel') }}">Gestionar ingredientes</a>
        <a href="{{ route('sabores.panel') }}">Gestionar sabores</a>
        <a href="{{ route('tipos.panel') }}">Gestionar tipos de productos</a>
        <a href="{{ route('unidades.panel') }}">Gestionar unidades de medida</a>
    </div>
@endsection