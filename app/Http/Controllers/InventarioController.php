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
        $productos = PlanCompra::all();
        return view('inventario', compact('productos'));
    }

    public function actualizar(Request $request, $referencia)
    {
        // Verificar si el usuario ha iniciado sesión
        if (!Session::has('usuario_id')) {
            return redirect()->route('login')->withErrors([
                'acceso' => 'Debes iniciar sesión para acceder a esta página.',
            ]);
        }

        // Buscar el producto por su referencia
        $producto = PlanCompra::where('referencia', $referencia)->first();

        // Validar los datos del formulario
        $request->validate([
            'consumo_mrp' => 'required|integer|min:0',
            'consumo' => 'required|integer|min:0',
            'pedido' => 'required|integer|min:0',
        ]);

        // Actualizar los campos del producto
        $producto->update([
            'consumo_mrp' => $request->consumo_mrp,
            'consumo' => $request->consumo,
            'pedido' => $request->pedido,
        ]);

        // Redirigir a la página de inventario con un mensaje de éxito
        return redirect()->route('inventario')->with('success', 'Datos actualizados exitosamente.');
    }
}
