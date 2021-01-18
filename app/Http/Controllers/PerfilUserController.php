<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class PerfilUserController extends Controller
{
    public function perfil($usuario){
        if (auth()->user()->nombre == $usuario){
            return redirect()->route('me');
        }
        else{
            $usuario = Usuario::where('nombre', '=', $usuario)->first();
            if ($usuario != null){
               return view('perfil-Friend', ['usuario' => $usuario]);
            }
            else{
                return back();
            }
        }
       
    }
}
