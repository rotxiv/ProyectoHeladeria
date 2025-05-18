<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f2f2f2;
            color: #333;
            text-align: center;
        }
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            margin-bottom: 20px;
        }
        a.button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #0275d8;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        a.button:hover {
            background-color: #025aa5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido a Mi Aplicación Laravel</h1>
        <p>Por favor, inicia sesión para acceder a tu panel de control.</p>
        <a href="{{ route('login') }}" class="button">Iniciar sesión</a>
    </div>
</body>
</html>
