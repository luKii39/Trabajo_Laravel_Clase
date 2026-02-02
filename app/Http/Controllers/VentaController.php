<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Crear venta
        $venta = Venta::create([
            'cliente_id' => $request->cliente_id,
            'fecha' => $request->fecha,
            'total' => 0,
        ]);

        $total = 0;

        // Crear detalles
        foreach ($request->productos as $item) {
            $producto = Producto::find($item['id']);
            $cantidad = $item['cantidad'];
            $precio = $producto->precio;
            $subtotal = $precio * $cantidad;

            VentaDetalle::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto->id,
                'cantidad' => $cantidad,
                'precio' => $precio,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        // Actualizar total
        $venta->update(['total' => $total]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }
}
