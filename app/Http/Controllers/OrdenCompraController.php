<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrdenCompraController extends Controller
{
    public function mostrar()
    {
        if (!Session::has('usuario_id')) {
            return redirect()->route('login')->withErrors([
                'acceso' => 'Debes iniciar sesión para acceder a esta página.',
            ]);
        }

        $productosActualizados = Session::get('productos_actualizados', []);

        Session::forget('productos_actualizados');

        return view('orden_compra', compact('productosActualizados'));
    }
}
