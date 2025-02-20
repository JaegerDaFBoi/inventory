<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email',
            'contraseña' => 'required|string|min:8|max:8',
        ]);

        $usuario = Usuario::where('correo_electronico', $request->correo_electronico)->first();

        if ($usuario && $request->contraseña === $usuario->credencial->contraseña) {
            // Iniciar sesión manualmente
            Session::put('usuario_id', $usuario->id);

            // Redirigir al usuario a la página de inventario
            return redirect()->route('inventario');
        }

        // Si las credenciales son incorrectas, redirigir con un mensaje de error
        return back()->withErrors([
            'correo_electronico' => 'Las credenciales proporcionadas no son válidas.',
        ]);
    }

    // Método para cerrar sesión
    public function logout()
    {
        Session::forget('usuario_id');

        return redirect('/');
    }
}
