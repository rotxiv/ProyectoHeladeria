<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi Aplicación')</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .container {
            background-color: white;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #00796b;
        }

        p {
            font-size: 16px;
            margin-bottom: 30px;
        }

        a.button, button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #00796b;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }

        a.button:hover, button:hover {
            background-color: #004d40;
        }

        footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')

        <footer>
            © {{ date('Y') }} Mi Empresa. Todos los derechos reservados.
        </footer>
    </div>
</body>
</html>
