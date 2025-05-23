@extends('layouts.' . strtolower(Auth::user()->rolActivo()->nombre))

@section('title', 'Detalle del Tipo de Producto')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Detalle del Tipo de Producto</h2>

    <div class="card shadow">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Código</dt>
                <dd class="col-sm-9">{{ $tipo->codigo }}</dd>

                <dt class="col-sm-3">Descripción</dt>
                <dd class="col-sm-9">{{ $tipo->descripcion }}</dd>
            </dl>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('tiposindex') }}" class="btn btn-secondary">Volver al listado</a>
                <a href="{{ route('tipos.edit', $tipo->id) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection
