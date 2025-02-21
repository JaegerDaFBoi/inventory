<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Inventario</h1>
        <a href="{{ route('inventario.crear') }}" class="btn btn-success mb-3">
            Agregar Nuevo Producto
        </a>
        <form action="{{ route('inventario.actualizar') }}" method="POST">
            @csrf
            @method('PUT')
            <table class="table">
                <thead>
                    <tr>
                        <th>Referencia</th>
                        <th>Materia Prima</th>
                        <th>Inventario Actual</th>
                        <th>Cantidad</th>
                        <th>Stock de Seguridad</th>
                        <th>Consumo MRP</th>
                        <th>Consumo</th>
                        <th>Pedido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>{{ $producto->referencia }}</td>
                            <td>{{ $producto->materia_prima }}</td>
                            <td>{{ $producto->inventario_actual }}</td>
                            <td>{{ $producto->cantidad }}</td>
                            <td>{{ $producto->stock_seguridad }}</td>
                            <td>
                                <input type="number" name="productos[{{ $producto->referencia }}][consumo_mrp]" value="{{ $producto->consumo_mrp }}" class="form-control">
                            </td>
                            <td>
                                <input type="number" name="productos[{{ $producto->referencia }}][consumo]" value="{{ $producto->consumo }}" class="form-control">
                            </td>
                            <td>
                                <input type="number" name="productos[{{ $producto->referencia }}][pedido]" value="{{ $producto->pedido }}" class="form-control">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>
</body>
</html>