<?php

namespace App\Http\Controllers;

use App\Models\BpadAmigo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginDetail;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function logout(Usuario $usuario)
    {
        eliminarAmigosRecomendados();
        Auth::logout();
        LoginDetail::where('user_id', $usuario->id)->delete();
        return redirect()->route('home');
    }
}
