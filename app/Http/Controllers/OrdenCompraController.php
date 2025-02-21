<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrdenCompraController extends Controller
{
    // Método para mostrar la página de "Orden de Compra"
    public function mostrar()
    {
        // Verificar si el usuario ha iniciado sesión
        if (!Session::has('usuario_id')) {
            return redirect()->route('login')->withErrors([
                'acceso' => 'Debes iniciar sesión para acceder a esta página.',
            ]);
        }

        // Obtener los productos actualizados de la sesión
        $productosActualizados = Session::get('productos_actualizados', []);

        // Limpiar la sesión después de usar los datos
        Session::forget('productos_actualizados');

        return view('orden_compra', compact('productosActualizados'));
    }
}
