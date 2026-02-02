@extends('adminlte::page')

@section('title', 'Nueva compra')

@section('content_header')
    <h1>Nueva compra</h1>
@endsection

@section('content')

    <form action="{{ route('compras.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Proveedor</label>
            <select name="proveedor_id" class="form-control" required>
                <option value="">Seleccione un proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
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
                    <th>Precio compra (€)</th>
                    <th>Cantidad</th>
                    <th>Subtotal (€)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <button type="button" class="btn btn-secondary mb-3" id="btn-agregar">Agregar producto</button>

        <h3>Total: <span id="total">0.00</span> €</h3>

        <button type="submit" class="btn btn-primary">Guardar compra</button>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
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
                    ${productos.map(p => `<option value="${p.id}">${p.nombre}</option>`).join('')}
                </select>
            </td>

            <td>
                <input type="number" name="productos[${index}][precio]" class="form-control precio" min="0" step="0.01" value="0" required>
            </td>

            <td>
                <input type="number" name="productos[${index}][cantidad]" class="form-control cantidad" min="1" value="1" required>
            </td>

            <td class="subtotal">0.00</td>

            <td>
                <button type="button" class="btn btn-danger btn-sm btn-eliminar">X</button>
            </td>
        `;

        tabla.appendChild(fila);
        index++;
        actualizarEventos();
    });

    function actualizarEventos() {
        document.querySelectorAll('.precio').forEach(input => {
            input.oninput = function () {
                actualizarSubtotal(this.closest('tr'));
            };
        });

        document.querySelectorAll('.cantidad').forEach(input => {
            input.oninput = function () {
                actualizarSubtotal(this.closest('tr'));
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
        let precio = parseFloat(fila.querySelector('.precio').value) || 0;
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
