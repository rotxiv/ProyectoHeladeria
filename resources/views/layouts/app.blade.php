<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel</title>
</head>
<body>

    {{-- Menú según el rol --}}
    @php
        $rol = Auth::user()->rolActivo()->nombre;
    @endphp

    @if ($rol === 'Administrador')
        @include('administrador.dashboard')
    @elseif ($rol === 'Gerente')
        @include('gerente.dashboard')
    @elseif ($rol === 'EncargadoCocina')
        @include('encargadococina.dashboard')
    @elseif ($rol === 'Camarero')
        @include('camarero.dashboard')
    @elseif ($rol === 'Recepcionista')
        @include('recepcionista.dashboard')
    @endif

    <div class="container">
        @yield(section: 'content')
    </div>

</body>
</html>
