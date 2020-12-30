<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\WebEvento;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function index(){
        $videos = WebEvento::orderBy('id', 'DESC')
        ->where('tipo', 1)
        ->paginate(4);

        $eventos = WebEvento::orderBy('fecha', 'ASC')
        ->where('tipo', 2)
        ->paginate(4);   
        return view('registro', compact('videos', 'eventos'));
    }

    public function create(RegistroRequest $request){

        $usuario = new Usuario();
        $usuario->nombre = $request->get('nombre');
        $usuario->password = Gcrypt($request->get('password'));
        $usuario->avatar = intval($request->get('avatar'));
        $usuario->colores = "B88A5CFF99000099CC0099CCE31709FFFFFF336666";
        $usuario->email = $request->get('email');;
        $usuario->edad = 14;
        $usuario->ip_registro = "";
        $usuario->ip_actual = "";
        $usuario->fecha_registro = date("Y-m-d H:i:s");
        $usuario->save();

        Auth::login($usuario);
        
        return response()->json([
        ], Response::HTTP_CREATED);    
    }
}
