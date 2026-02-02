@extends('adminlte::page')

@section('title', 'Nueva venta')

@section('content_header')
    <h1>Nueva venta</h1>
@endsection

@section('content')

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Cliente</label>
            <select name="cliente_id" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>

        <hr>

        <h4>Productos</h4>

        <table class="table" id="tabla-productos">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio (€)</th>
                    <th>Cantidad</th>
                    <th>Subtotal (€)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <button type="button" class="btn btn-secondary mb-3" id="btn-agregar">Agregar producto</button>

        <h3>Total: <span id="total">0.00</span> €</h3>

        <button type="submit" class="btn btn-primary">Guardar venta</button>
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

@endsection

@section('js')
<script>
    let productos = @json($productos);
    let index = 0;

    document.getElementById('btn-agregar').addEventListener('click', function () {
        let tabla = document.querySelector('#tabla-productos tbody');

        let fila = document.createElement('tr');

        fila.innerHTML = `
            <td>
                <select name="productos[${index}][id]" class="form-control producto-select" required>
                    <option value="">Seleccione</option>
                    ${productos.map(p => `<option value="${p.id}" data-precio="${p.precio}">${p.nombre}</option>`).join('')}
                </select>
            </td>
            <td class="precio">0.00</td>
            <td><input type="number" name="productos[${index}][cantidad]" class="form-control cantidad" min="1" value="1" required></td>
            <td class="subtotal">0.00</td>
            <td><button type="button" class="btn btn-danger btn-sm btn-eliminar">X</button></td>
        `;

        tabla.appendChild(fila);
        index++;
        actualizarEventos();
    });

    function actualizarEventos() {
        document.querySelectorAll('.producto-select').forEach(select => {
            select.onchange = function () {
                let precio = this.selectedOptions[0].dataset.precio || 0;
                let fila = this.closest('tr');
                fila.querySelector('.precio').innerText = parseFloat(precio).toFixed(2);
                actualizarSubtotal(fila);
            };
        });

        document.querySelectorAll('.cantidad').forEach(input => {
            input.oninput = function () {
                let fila = this.closest('tr');
                actualizarSubtotal(fila);
            };
        });

        document.querySelectorAll('.btn-eliminar').forEach(btn => {
            btn.onclick = function () {
                this.closest('tr').remove();
                actualizarTotal();
            };
        });
    }

    function actualizarSubtotal(fila) {
        let precio = parseFloat(fila.querySelector('.precio').innerText) || 0;
        let cantidad = parseInt(fila.querySelector('.cantidad').value) || 0;
        let subtotal = precio * cantidad;
        fila.querySelector('.subtotal').innerText = subtotal.toFixed(2);
        actualizarTotal();
    }

    function actualizarTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(sub => {
            total += parseFloat(sub.innerText) || 0;
        });
        document.getElementById('total').innerText = total.toFixed(2);
    }
</script>
@endsection
