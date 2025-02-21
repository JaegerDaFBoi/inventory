<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                @foreach($productosActualizados as $producto)
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
</body>
</html>