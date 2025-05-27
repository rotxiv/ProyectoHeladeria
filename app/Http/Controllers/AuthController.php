<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Obtenemos el usuario autenticado
            $user = Auth::user();
            $rol = $user->rolActivo();

            if (!$rol) {
                Auth::logout();
                return back()->withErrors(['email' => 'No tienes un rol activo.']);
            }

            // Redireccionamos según el nombre del rol
            switch ($rol->nombre) {
                case 'Administrador':
                    return redirect()->route('administrador.dashboard');
                case 'Gerente':
                    return redirect()->route('gerente.dashboard');
                case 'Recepcionista':
                    return redirect()->route('recepcionista');
                case 'EncargadoCocina':
                    return redirect()->route('encargado-cocina.dashboard');
                case 'Camarero':
                    return redirect()->route('camarero');
                default:
                    Auth::logout();
                    return back()->withErrors(['email' => 'Rol no reconocido.']);
            }
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Cierra la sesión del usuario
        
        $request->session()->invalidate(); // Invalida la sesión
        
        $request->session()->regenerateToken(); // Regenera el token CSRF
        
        return redirect()->route('principal');
    }
}