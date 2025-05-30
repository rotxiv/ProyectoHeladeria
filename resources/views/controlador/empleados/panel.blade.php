@extends('layouts.app')

@section('title', 'Panel de Empleados')

@section('content')

@php
    $rol = strtolower(Auth::user()->rolActivo()->nombre);
@endphp

<div class="container">

    @if(isset($mensaje))
        <div class="alert alert-success">
            {{ $mensaje }}
        </div>
    @endif

    <h2 class="page-title">Panel de Empleados</h2>

    <div class="card">
        <ul class="panel-options">
            <li><a href="{{ route($rol.'.empleados.index') }}">📋 Listar empleados</a></li>
            <li><a href="{{ route($rol.'.empleados.create') }}">➕ Crear nuevo empleado</a></li>
        </ul>

        <hr class="my-4">

        <h5 class="mb-3">🔍 Buscar empleado por carnet</h5>
        <form action="{{ route($rol.'.empleados.showByCarnet') }}" method="GET">
            <div class="mb-3">
                <label for="carnet" class="form-label">Carnet</label>
                <input type="text" name="carnet" id="carnet" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

    </div>
</div>

<style>
    .container {
        transform: translateX(50px);
        max-width: 700px;
        margin: 40px auto;
        padding: 20px;
    }

    .page-title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 26px;
        color: #333;
    }

    .card {
        background: #fdfdfd;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .panel-options {
        list-style: none;
        padding-left: 0;
    }

    .panel-options li {
        margin: 15px 0;
    }

    .panel-options a {
        font-size: 18px;
        text-decoration: none;
        color: #007bff;
    }

    .panel-options a:hover {
        text-decoration: underline;
    }

    input.form-control {
        max-width: 300px;
    }
</style>
@endsection
