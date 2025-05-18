@extends('layouts.simple')

@section('title', 'Bienvenido')

@section('content')
    <h1>Bienvenido a Mi Aplicación Laravel</h1>
    <p>Inicia sesión para acceder a tu panel de control personalizado.</p>
    <a href="{{ route('login') }}" class="button">Iniciar sesión</a>
@endsection

