@extends('layouts.dashboard')

@section('title', 'Orden de Compra')

@section('content')
    <div class="container mt-5">
        <h1>Orden de Compra</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Materia Prima</th>
                    <th>Cantidad</th>
                    <th>Pedido</th>
                    <th>Final Teórico</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productosActualizados as $producto)
                    <tr>
                        <td>{{ $producto->referencia }}</td>
                        <td>{{ $producto->materia_prima }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td>{{ $producto->pedido }}</td>
                        <td>{{ $producto->final_teorico }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('inventario') }}" class="btn btn-secondary">Volver al Inventario</a>
    </div>
@endsection
