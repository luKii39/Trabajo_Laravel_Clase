@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    <h1>Editar Producto</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
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

            <div class="form-group">
                <label>Imagen del producto</label>
                @if ($producto->imagen)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $producto->imagen) }}" width="100">
                    </div>
                @endif
                <input type="file" name="imagen" class="form-control" accept="image/*">
            </div>

            <div class="form-group">
                <label>Archivo PDF</label>
                @if ($producto->pdf)
                    <div class="mb-2">
                        <a href="{{ asset('storage/' . $producto->pdf) }}" target="_blank">Ver PDF actual</a>
                    </div>
                @endif
                <input type="file" name="pdf" class="form-control" accept=".pdf">
            </div>

            <button class="btn btn-primary">Actualizar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>

    </div>
</div>

@endsection