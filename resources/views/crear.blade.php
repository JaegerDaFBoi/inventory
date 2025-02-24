@extends('layouts.dashboard')

@section('title', 'Crear producto')

@section('content')
    <div class="container mt-5">
        <h1>Crear Nuevo Producto</h1>
        <form action="{{ route('inventario.guardar') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="materia_prima" class="form-label">Materia Prima</label>
                        <input type="text" class="form-control" id="materia_prima" name="materia_prima" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="inventario_actual" class="form-label">Inventario Actual</label>
                        <input type="number" class="form-control" id="inventario_actual" name="inventario_actual" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="stock_seguridad" class="form-label">Stock de Seguridad</label>
                        <input type="number" class="form-control" id="stock_seguridad" name="stock_seguridad" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('inventario') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
