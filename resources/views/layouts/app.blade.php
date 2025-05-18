<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f2f2f2;
            color: #333;
        }
        header {
            background-color: #333;
            color: white;
            padding: 15px;
            border-radius: 8px;
        }
        main {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        button {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>

    <header>
        <h1>@yield('header')</h1>
    </header>

    <main>
        <p>Bienvenido, {{ Auth::user()->name }}</p>

        @yield('content')

        <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </main>

</body>
</html>
