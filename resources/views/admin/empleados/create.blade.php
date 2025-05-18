@extends('layouts.admin')

@section('content')
    <h2>Registrar Nuevo Empleado</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.empleados.store') }}" method="POST">
        @csrf

        <fieldset style="border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem;">
            <legend>Datos Personales</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required><br>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" required><br>

            <label for="carnet">Carnet:</label>
            <input type="text" name="carnet" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono"><br>
        </fieldset>

        <fieldset style="border: 1px solid #ccc; padding: 1rem;">
            <legend>Datos del Empleado</legend>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" required><br>
        </fieldset>

        <button type="submit">Registrar</button>
    </form>
@endsection
