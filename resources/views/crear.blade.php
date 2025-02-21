<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Crear Nuevo Producto</h1>
        <form action="{{ route('inventario.guardar') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="materia_prima" class="form-label">Materia Prima</label>
                <input type="text" class="form-control" id="materia_prima" name="materia_prima" required>
            </div>
            <div class="mb-3">
                <label for="inventario_actual" class="form-label">Inventario Actual</label>
                <input type="number" class="form-control" id="inventario_actual" name="inventario_actual" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="text" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            <div class="mb-3">
                <label for="stock_seguridad" class="form-label">Stock de Seguridad</label>
                <input type="number" class="form-control" id="stock_seguridad" name="stock_seguridad" required>
            </div>
            <div class="mb-3">
                <label for="consumo_mrp" class="form-label">Consumo MRP</label>
                <input type="number" class="form-control" id="consumo_mrp" name="consumo_mrp" required>
            </div>
            <div class="mb-3">
                <label for="consumo" class="form-label">Consumo</label>
                <input type="number" class="form-control" id="consumo" name="consumo" required>
            </div>
            <div class="mb-3">
                <label for="pedido" class="form-label">Pedido</label>
                <input type="number" class="form-control" id="pedido" name="pedido" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('inventario') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>