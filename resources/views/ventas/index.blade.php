@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1>Ventas</h1>
@endsection

@section('content')

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Nueva venta</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="tabla-ventas" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total (€)</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->cliente->nombre }}</td>
                    <td>{{ $venta->fecha }}</td>
                    <td>{{ number_format($venta->total, 2) }} €</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="toggleDetalles({{ $venta->id }})">
                            Ver detalles
                        </button>
                        @if (auth()->user()->isAdmin())
                            <form action="{{ route('ventas.destroy', $venta) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar venta?')">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
                <tr id="detalles-{{ $venta->id }}" style="display: none;">
                    <td colspan="5">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio (€)</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal (€)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($venta->detalles as $detalle)
                                    <tr>
                                        <td>{{ $detalle->producto->nombre }}</td>
                                        <td>{{ number_format($detalle->precio, 2) }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>{{ number_format($detalle->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay ventas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#tabla-ventas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });

    function toggleDetalles(id) {
        let fila = document.getElementById('detalles-' + id);
        fila.style.display = fila.style.display === 'none' ? '' : 'none';
    }
</script>
@endsection