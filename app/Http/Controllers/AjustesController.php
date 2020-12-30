<?php

namespace App\Http\Controllers;

use App\Http\Requests\CambiarClaveAjustesRequest;
use App\Http\Requests\CambiarEmailAjustesRequest;
use App\Http\Requests\CambiarPasswordAjustesRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AjustesController extends Controller
{
    public function cambiarPassword(CambiarPasswordAjustesRequest $request){

        $usuario = Usuario::where('id','=',  auth()->user()->id)
        ->first();
        if ($usuario != null){
            $usuario->password = Gcrypt($request->get('passwordRepeat'));
            $usuario->save();
        }
      

        return response()->json([
            'content' => 'Contraseña ha sido cambiada.',
        ], Response::HTTP_CREATED);     
    }

    public function cambiarClaveSeguridad(CambiarClaveAjustesRequest $request){
        $usuario = Usuario::where('id','=',  auth()->user()->id)
        ->first();
        if ($usuario != null){
            $usuario->security = $request->get('claveSeguridadRepeat');
            $usuario->save();
        }

        return response()->json([
            'content' => 'Clave de seguridad ha sido cambiada.',
        ], Response::HTTP_CREATED);     
    }

    public function cambiarEmail(CambiarEmailAjustesRequest $request){

        $usuario = Usuario::where('id','=',  auth()->user()->id)
        ->first();
        if ($usuario != null){
            $usuario->email = $request->get('emailRepeat');
            $usuario->save();
        }

        return response()->json([
            'content' => 'Email ha sido cambiado.',
        ], Response::HTTP_CREATED);  
    }
}
