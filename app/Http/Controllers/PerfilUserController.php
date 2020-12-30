<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class PerfilUserController extends Controller
{
    public function perfil($usuario){
        $usuario = Usuario::where('nombre', '=', $usuario)->first();
        if ($usuario != null){
           return view('perfil-Friend', ['usuario' => $usuario]);
        }
        else{
            return back();
        }
    }
}
