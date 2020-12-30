<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebContactoRequest;
use App\Models\WebContacto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebContactoController extends Controller
{
    public function addContacto(WebContactoRequest $request){

        $contacto = new WebContacto();
        $contacto->nombre = $request->get('nombre');
        $contacto->subject = $request->get('subject');
        $contacto->contenido = $request->get('contenido');
        $contacto->email = $request->get('email');
        $contacto->save();

        return response()->json([
            'content' => 'Tu email se ha enviado correctamente.',
        ], Response::HTTP_CREATED);   

    }
}
