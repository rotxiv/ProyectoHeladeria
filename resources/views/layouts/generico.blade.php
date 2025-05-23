<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel')</title>
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
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            padding-top: 80px;
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
    </style>

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
        @yield('sidebar')
    </div>

    <div class="main-content">
        <h2>@yield('title')</h2>
        @yield('content')
    </div>

    <footer>
        &copy; {{ date('Y') }} Heladería App - Todos los derechos reservados
    </footer>

    @stack('scripts')   <!-- seccion para scripts adicionales -->
</body>
</html>
