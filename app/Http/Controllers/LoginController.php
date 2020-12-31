<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\LoginDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    
    public function autentification(LoginRequest $request){
        $usuario = Usuario::where('nombre', $request->get('nombre'))
        ->where('password', Gcrypt($request->get('password')))
        ->first();
        
        if ($usuario != null){
            Auth::login($usuario);
            obtenerAmigosRecomendados();
            //LoginDetail::where('user_id', auth()->user()->id)->delete();

            $loginDetails = new LoginDetail();
            $loginDetails->user_id = auth()->user()->id;
            $loginDetails->save();


            return redirect()->intended('/me');
        }
        else{
            return back()
            ->withErrors(['nombre' => 'Los datos son incorrectos.'])
            ->withInput(request(['nombre']));
        }
    }
}
