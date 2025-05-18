@extends('layouts.admin')

@section('content')
    <h2>Registrar Nuevo Usuario</h2>

    <form action="{{ route('admin.empleados.store') }}" method="POST">
        @csrf
        <label for="empleado_id"> Empleado </label>
        <select name="empleado_id" id="empleado_id" required>
            <option value=""> Seleccione un empleado </option>
            @foreach ($empleados as $empleado)
                <option value="{{  $empleado->id }}"> {{ $empleado->persona->nombre }} </option>
            @endforeach
        </select>
        <br><br>
            <label for="name">Nombre de usuario:</label>
            <input type="text" name="name" id="name" required>
        <br><br>
            <label for="email">Correo:</label>
            <input type="email" name="email" id="email" required>
        <br><br>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
        <br><br>
        <button type="submit">Guardar</button>
    </form>
@endsection