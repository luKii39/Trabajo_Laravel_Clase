@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Listado de Productos</h1>
@endsection

@section('content')

<a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">
    Agregar Producto
</a>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="tabla-productos" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>
                    @if ($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" width="50" height="50" style="object-fit: cover; border-radius: 5px;">
                    @else
                        <span class="text-muted">Sin imagen</span>
                    @endif
                </td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>
                    @if (auth()->user()->isAdmin())
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">
                                Eliminar
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#tabla-productos').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });
</script>
@endsection