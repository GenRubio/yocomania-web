<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AdminLoginController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            if (auth()->user()->admin > 0) {
                return redirect()->intended('/admin-dashboard');
            } else {
                return view('adminLogin');
            }
        } else {
            return view('adminLogin');
        }
    }
    public function login(AdminLoginRequest $request)
    {
        $usuario = Usuario::where('nombre', $request->get('usuario'))
        ->where('password', Gcrypt($request->get('password')))
        ->first();

        if ($usuario != null) {
            Auth::login($usuario);
            
            if (auth()->user()->admin > 0) {
                return redirect()->intended('/admin-dashboard');
            } else {
                Auth::logout();
                return back()
                    ->withErrors(['usuario' => 'Nombre de usuario o contraseña incorrectos.'])
                    ->withInput(request(['usuario']));
            }
        } else {
            return back()
                ->withErrors(['usuario' => 'Nombre de usuario o contraseña incorrectos.'])
                ->withInput(request(['usuario']));
        }
    }
}
