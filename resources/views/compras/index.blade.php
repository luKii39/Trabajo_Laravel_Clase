@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
    <h1>Compras</h1>
@endsection

@section('content')

    <a href="{{ route('compras.create') }}" class="btn btn-primary mb-3">Nueva compra</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="tabla-compras" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Total (€)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($compras as $compra)
                <tr>
                    <td>{{ $compra->id }}</td>
                    <td>{{ $compra->proveedor->nombre }}</td>
                    <td>{{ $compra->fecha }}</td>
                    <td>{{ number_format($compra->total, 2) }} €</td>
                    <td>
                        @if (auth()->user()->isAdmin())
                            <form action="{{ route('compras.destroy', $compra) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar compra?')">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay compras registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#tabla-compras').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });
</script>
@endsection