<?php

namespace App\Http\Controllers;

use App\Models\ArmarioFicha;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FichasController extends Controller
{
    public function change(Request $request){
        if ($request->get('idFicha') == auth()->user()->edad){
            return back();
        }

        
        $fichaUsuario = ArmarioFicha::where('ficha_id', '=', $request->get('idFicha'))
        ->where('user_id', '=', auth()->user()->id)
        ->get();

        if ($fichaUsuario != null){
            Usuario::where('id', '=',  auth()->user()->id)
            ->update(['edad' => $request->get('idFicha')]);
        }
        else{
            return back();
        }

        return response()->json([
        ], Response::HTTP_CREATED);    
    }
}
