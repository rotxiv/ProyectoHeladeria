@extends('layouts.admin')

@section('content')
    <h2>Crear Nuevo Rol</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <label for="nombre">Nombre del Rol:</label>
        <input type="text" name="nombre" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" rows="3"></textarea><br>

        <button type="submit">Guardar Rol</button>
    </form>
@endsection

