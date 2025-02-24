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
        if (!Session::has('usuario_id')) {
            return redirect()->route('login')->withErrors([
                'acceso' => 'Debes iniciar sesión para acceder a esta página.',
            ]);
        }

        $productosActualizados = [];

        foreach ($request->productos as $referencia => $datos) {

            $producto = PlanCompra::where('referencia', $referencia)->first();
            

            if ($producto) {
                
  
                $producto->update([
                    'consumo_mrp' => $datos['consumo_mrp'],
                    'consumo' => $datos['consumo'],
                    'pedido' => $datos['pedido'],
                ]);
                if (
                    $datos['consumo_mrp'] != 0 ||
                    $datos['consumo']  != 0 ||
                    $datos['pedido']  != 0
                ) {
                    $productoActualizado = $producto->refresh();
                    $productosActualizados[] = $productoActualizado;
                }
            }
        }
        Session::put('productos_actualizados', $productosActualizados);

        return redirect()->route('orden.compra');
    }

    public function mostrarFormularioCreacion()
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('login')->withErrors([
                'acceso' => 'Debes iniciar sesión para acceder a esta página.',
            ]);
        }

        return view('crear');
    }

    public function crear(Request $request)
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('login')->withErrors([
                'acceso' => 'Debes iniciar sesión para acceder a esta página.',
            ]);
        }

        $request->validate([
            'materia_prima' => 'required|string|max:50',
            'inventario_actual' => 'required|integer|min:0',
            'cantidad' => 'required|string|max:50',
            'stock_seguridad' => 'required|integer|min:0',
        ]);

        $ultimaReferencia = PlanCompra::orderBy('referencia', 'desc')->first();

        $numero = 0;
        if ($ultimaReferencia) {
            $ultimoNumero = substr($ultimaReferencia->referencia, -2); 
            $numero = intval($ultimoNumero); 
        }

        $nuevoNumero = str_pad($numero + 1, 2, '0', STR_PAD_LEFT); 
        $nuevaReferencia = '096N0' . $nuevoNumero; 

        PlanCompra::create([
            'referencia' => $nuevaReferencia,
            'materia_prima' => $request->materia_prima,
            'inventario_actual' => $request->inventario_actual,
            'cantidad' => $request->cantidad,
            'stock_seguridad' => $request->stock_seguridad,
            'consumo_mrp' => 0,
            'consumo' => 0,
            'pedido' => 0,
        ]);

        return redirect()->route('inventario')->with('success', 'Producto creado exitosamente.');
    }
}
