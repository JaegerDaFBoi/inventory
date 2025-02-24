<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
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
            Session::put('usuario_id', $usuario->id);

            return redirect()->route('inventario');
        }

        return back()->withErrors([
            'correo_electronico' => 'Las credenciales proporcionadas no son válidas.',
        ]);
    }

    public function logout()
    {
        Session::forget('usuario_id');

        return redirect('/');
    }
}
