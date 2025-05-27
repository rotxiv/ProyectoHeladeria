<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel de Encargado de Cocina')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #2c3e50;
            color: #fff;
            padding: 15px 20px;
            font-size: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info {
            font-size: 16px;
        }

        .logout-form {
            display: inline;
        }

        .logout-form button {
            background: none;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            text-decoration: underline;
            margin-left: 10px;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #34495e;
            position: fixed;
            top: 60px;
            left: 0;
            padding-top: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .main-content {
            padding-left: 240px;
            padding: 20px;
            padding-top: 80px;
            transition: padding-left 0.3s ease-in-out;
        }

        footer {
            background-color: #2c3e50;
            color: #fff;
            padding: 15px 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: calc(100% - 220px);
            left: 220px;
        }

        .sidebar h4 {
            color: #bdc3c7;
            font-size: 14px;
            padding: 10px 20px 5px;
            margin: 0;
            cursor: pointer;
        }

        .submenu {
            display: none;
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

    <script>
        function toggleMenu(id) {
            var menu = document.getElementById(id);
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }
    </script>

    @stack('styles')
</head>
<body>

    <header>
        <div>Sistema de Gestión de Heladería</div>

        <div class="user-info">
            Bienvenido, {{ Auth::user()->name ?? 'Usuario' }} |
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>
    </header>

    <div class="sidebar">
        <div class="user-sidebar-info" style="text-align: center; padding: 15px; border-bottom: 1px solid #7f8c8d;">
            <div class="avatar-circle" style="
                width: 70px;
                height: 70px;
                border-radius: 50%;
                background-color: #2980b9;
                color: white;
                font-size: 28px;
                line-height: 70px;
                margin: 0 auto 10px;
                font-weight: bold;
                text-transform: uppercase;
                ">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <strong style="color: #ecf0f1;">{{ Auth::user()->name ?? 'Usuario' }}</strong>
        </div>

        <a href="{{ route('encargado-cocina.dashboard') }}" style="display: block; padding: 10px 20px; font-size: 16px; color: #ecf0f1; text-decoration: none; background-color: #2980b9;">
            Panel Principal
        </a>

        <h4 onclick="toggleMenu('menu-cocina')">Administrar Cocina</h4>
        <div class="submenu" id="menu-cocina">
            <a href="{{ route('encargado-cocina.productos.panel') }}">Gestionar productos</a>
            <a href="{{ route('encargado-cocina.ingredientes.panel') }}">Gestionar ingredientes</a>
            <a href="{{ route('encargado-cocina.sabores.panel') }}">Gestionar sabores</a>
            <a href="{{ route('encargado-cocina.tipos.panel') }}">Gestionar tipos de productos</a>
            <a href="{{ route('encargado-cocina.unidades.panel') }}">Gestionar unidades de medida</a>
        </div>

        <!-- @yield('sidebar') -->
    </div>

    <footer>
        &copy; {{ date('Y') }} Heladería App - Todos los derechos reservados
    </footer>

    @stack('scripts')
</body>
</html>



<!-- @extends('layouts.generico')

@section('title', 'Panel de Encargado de Cocina')

@section('sidebar')
    <h4 style="color: #bdc3c7; padding: 10px 20px;">Administrar Cocina</h4>
    <div class="submenu" style="display: flex; flex-direction: column; gap: 8px; padding: 0 20px;">
        <a href="{{ route('encargado-cocina.productos.panel') }}">Gestionar productos</a>
        <a href="{{ route('encargado-cocina.ingredientes.panel') }}">Gestionar ingredientes</a>
        <a href="{{ route('encargado-cocina.sabores.panel') }}">Gestionar sabores</a>
        <a href="{{ route('encargado-cocina.tipos.panel') }}">Gestionar tipos de productos</a>
        <a href="{{ route('encargado-cocina.unidades.panel') }}">Gestionar unidades de medida</a>
    </div>
@endsection

@section('content')
    <div style="background-color: #d4edda; padding: 20px; border: 1px solid #c3e6cb; border-radius: 8px; color: #155724;">
        <h3>Panel listo para gestionar la cocina</h3>
        <p>Selecciona una opción del menú lateral para comenzar.</p>
    </div>
@endsection -->
