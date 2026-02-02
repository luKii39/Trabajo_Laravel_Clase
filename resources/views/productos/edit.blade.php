@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    <h1>Editar Producto</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('productos.update', $producto) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
            </div>

            <div class="form-group">
                <label>Precio</label>
                <input type="number" name="precio" class="form-control" step="0.01" value="{{ $producto->precio }}" required>
            </div>

            <div class="form-group">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ $producto->stock }}" required>
            </div>

            <button class="btn btn-primary">Actualizar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>

    </div>
</div>

@endsection
