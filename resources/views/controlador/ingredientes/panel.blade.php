@extends('layouts.' . strtolower(Auth::user()->rolActivo()->nombre))

@section('title', 'Panel de Ingredientes')

@section('content')
<div class="container">
    <h2 class="page-title">Panel de Ingredientes</h2>

    <div class="card">
        <ul class="panel-options">
            <li><a href="{{ route('ingredientes.index') }}">📋 Listar ingredientes</a></li>
            <li><a href="{{ route('ingredientes.create') }}">➕ Crear nuevo ingrediente</a></li>
            <li><a href="#">🔍 Buscar ingrediente (próximamente)</a></li>
        </ul>
    </div>
</div>

<style>
    .container {
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
</style>
@endsection
