<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PlanCompra;

class InventarioController extends Controller
{
    public function index()
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('login')->withErrors([
                'acceso' => 'Debes iniciar sesión para acceder a esta página.',
            ]);
        }
        $productos = PlanCompra::orderBy('referencia')->get();
        return view('inventario', compact('productos'));
    }

    public function actualizar(Request $request)
    {
        // Verificar si el usuario ha iniciado sesión
        if (!Session::has('usuario_id')) {
            return redirect()->route('login')->withErrors([
                'acceso' => 'Debes iniciar sesión para acceder a esta página.',
            ]);
        }

        // Recopilar los productos actualizados
        $productosActualizados = [];

        // Recorrer los datos enviados desde el formulario
        foreach ($request->productos as $referencia => $datos) {
            // Buscar el producto por su referencia
            $producto = PlanCompra::where('referencia', $referencia)->first();

            if ($producto) {
                // Actualizar los campos del producto
                $producto->update([
                    'consumo_mrp' => $datos['consumo_mrp'],
                    'consumo' => $datos['consumo'],
                    'pedido' => $datos['pedido'],
                ]);

                // Recargar el producto desde la base de datos para obtener el valor actualizado de final_teorico
                $productoActualizado = PlanCompra::find($producto->id);

                // Agregar el producto actualizado a la lista
                $productosActualizados[] = $productoActualizado;
            }
        }

        // Guardar la lista de productos actualizados en la sesión
        Session::put('productos_actualizados', $productosActualizados);

        

        // Redirigir a la página de "Orden de Compra"
        return redirect()->route('orden.compra');
    }

    public function mostrarFormularioCreacion()
    {
        // Verificar si el usuario ha iniciado sesión
        if (!Session::has('usuario_id')) {
            return redirect()->route('login')->withErrors([
                'acceso' => 'Debes iniciar sesión para acceder a esta página.',
            ]);
        }

        return view('crear');
    }

    public function crear(Request $request)
    {
        // Verificar si el usuario ha iniciado sesión
        if (!Session::has('usuario_id')) {
            return redirect()->route('login')->withErrors([
                'acceso' => 'Debes iniciar sesión para acceder a esta página.',
            ]);
        }

        // Validar los datos del formulario
        $request->validate([
            'materia_prima' => 'required|string|max:50',
            'inventario_actual' => 'required|integer|min:0',
            'cantidad' => 'required|string|max:50',
            'stock_seguridad' => 'required|integer|min:0',
            'consumo_mrp' => 'required|integer|min:0',
            'consumo' => 'required|integer|min:0',
            'pedido' => 'required|integer|min:0',
        ]);

        // Obtener la última referencia de la tabla plan_compras
        $ultimaReferencia = PlanCompra::orderBy('referencia', 'desc')->first();

        // Extraer el número de la última referencia
        $numero = 0;
        if ($ultimaReferencia) {
            $ultimoNumero = substr($ultimaReferencia->referencia, -2); // Extraer los últimos 2 dígitos
            $numero = intval($ultimoNumero); // Convertir a entero
        }

        // Generar la nueva referencia
        $nuevoNumero = str_pad($numero + 1, 2, '0', STR_PAD_LEFT); // Incrementar y formatear a 2 dígitos
        $nuevaReferencia = '096N0' . $nuevoNumero; // Concatenar con el prefijo

        // Crear el nuevo producto
        PlanCompra::create([
            'referencia' => $nuevaReferencia,
            'materia_prima' => $request->materia_prima,
            'inventario_actual' => $request->inventario_actual,
            'cantidad' => $request->cantidad,
            'stock_seguridad' => $request->stock_seguridad,
            'consumo_mrp' => $request->consumo_mrp,
            'consumo' => $request->consumo,
            'pedido' => $request->pedido,
        ]);

        // Redirigir a la página de inventario con un mensaje de éxito
        return redirect()->route('inventario')->with('success', 'Producto creado exitosamente.');
    }
}
