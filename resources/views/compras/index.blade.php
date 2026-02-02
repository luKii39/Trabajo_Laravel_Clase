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

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Total (€)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($compras as $compra)
                <tr>
                    <td>{{ $compra->id }}</td>
                    <td>{{ $compra->proveedor->nombre }}</td>
                    <td>{{ $compra->fecha }}</td>
                    <td>{{ number_format($compra->total, 2) }} €</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay compras registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
