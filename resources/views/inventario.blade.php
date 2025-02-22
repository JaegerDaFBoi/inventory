@extends('layouts.dashboard')

@section('title', 'Inventario')

@section('content')
    <div class="container">
        <h1>Inventario</h1>
        <form action="{{ route('inventario.actualizar') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row m-2">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary" id="saveChangesBtn" disabled>Guardar Cambios</button>
                </div>
            </div>
            <div class="py-2 table-container" id="tableContainer"
                style="max-height: 70vh; overflow-y: auto; border: 2px solid black;">
                <table class="table table-bordered table-striped rounded">
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
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->referencia }}</td>
                                <td>{{ $producto->materia_prima }}</td>
                                <td>{{ $producto->inventario_actual }}</td>
                                <td>{{ $producto->cantidad }}</td>
                                <td>{{ $producto->stock_seguridad }}</td>
                                <td>
                                    <input type="number" name="productos[{{ $producto->referencia }}][consumo_mrp]"
                                        value="0" class="form-control input-field" min="0">
                                </td>
                                <td>
                                    <input type="number" name="productos[{{ $producto->referencia }}][consumo]"
                                        value="0" class="form-control input-field" min="0">
                                </td>
                                <td>
                                    <input type="number" name="productos[{{ $producto->referencia }}][pedido]"
                                        value="0" class="form-control input-field" min="0">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <script>
        // Habilitar el botón "Guardar Cambios" cuando se modifique algún campo
        document.addEventListener('DOMContentLoaded', function() {
            const inputFields = document.querySelectorAll('.input-field');
            const saveChangesBtn = document.getElementById('saveChangesBtn');

            inputFields.forEach(input => {
                input.addEventListener('input', () => {
                    saveChangesBtn.disabled = false; // Habilitar el botón
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputFields = document.querySelectorAll('.input-field');
            const saveChangesBtn = document.getElementById('saveChangesBtn');
    
            // Guardar los valores iniciales de los campos
            const initialValues = {};
            inputFields.forEach(input => {
                initialValues[input.name] = input.value;
            });
    
            inputFields.forEach(input => {
                input.addEventListener('input', () => {
                    // Verificar si algún campo ha cambiado
                    const hasChanges = Array.from(inputFields).some(input => input.value !== initialValues[input.name]);
                    saveChangesBtn.disabled = !hasChanges; // Habilitar o deshabilitar el botón
                });
            });
        });
    </script>
@endsection
