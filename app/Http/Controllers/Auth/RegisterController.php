<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Credencial;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.registro');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'correo_electronico' => 'required|email|max:150|unique:usuarios,correo_electronico',
            'contraseña' => 'required|string|min:8|max:8|regex:/^[A-Za-z0-9]{8}$/',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo_electronico' => $request->correo_electronico,
        ]);

        $credencial = Credencial::create([
            'id_usuario' => $usuario->id,
            'contraseña' => $request->contraseña, 
        ]);

        var_dump($credencial);

        return redirect()->route('registro')->with('success', 'Usuario registrado exitosamente.');
    }
}
