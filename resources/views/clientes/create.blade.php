@extends('adminlte::page')

@section('title', 'Nuevo cliente')

@section('content_header')
    <h1>Nuevo cliente</h1>
@endsection

@section('content')

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Correo electrónico</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>

        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

@endsection
