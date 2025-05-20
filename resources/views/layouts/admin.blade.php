<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: white;
            padding: 1rem;
        }

        nav {
            background-color: #444;
            padding: 0.5rem;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 1rem;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 2rem;
        }

        footer {
            margin-top: 2rem;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Panel del Administrador</h1>
    </header>

    <nav>
        <a href="{{ route('admin.dashboard') }}">Inicio</a>
        <a href="{{ route('admin.empleados.panel') }}">Empleados</a>
        <a href="{{ route('admin.clientes.index') }}">Clientes</a>
        <a href="{{ route('admin.usuarios.index') }}">Usuarios</a>
        <a href="{{ route('admin.roles.index') }}">Roles</a>
        <a href="{{ route('admin.tipos.index') }}">Tipos</a>
        <a href="{{ route('admin.sabores.index') }}">Sabores</a>
        <a href="{{ route('admin.unidades.index') }}">Unidades</a>
        <a href="{{ route('admin.ingredientes.index') }}">Ingredientes</a>
        <a href="{{ route('admin.productos.index') }}">Producto</a>

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="background:none; color:white; border:none; cursor:pointer;">Cerrar sesión</button>
        </form>
    </nav>

    <div class="container">
        @yield('content')       <!-- Aqui va el contenido -->
    </div>

    <footer>
        &copy; {{ date('Y') }} - Proyecto Heladería
    </footer>
</body>
</html>
