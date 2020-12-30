<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportRequest;
use App\Models\WebSupport;
use App\Models\WebSupportMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupportController extends Controller
{
    public function send(SupportRequest $request){
        $contacto = new WebSupport();
        $contacto->user_name = auth()->user()->nombre;
        $contacto->user_id = auth()->user()->id;
        $contacto->subject = $request->get('subject');
        $contacto->comentario = $request->get('comentarioSupport');
        $contacto->save();

        return response()->json([
            'result' => 'Se ha enviado correo al Soporte.',
        ], Response::HTTP_CREATED);      
    }
    public function get(Request $request){
        $mensajes = WebSupportMessage::where('id_usuario', auth()->user()->id)
        ->orderBy('id', 'DESC')
        ->get();
        return response()->json([
            'content' => view('components.dashboard.support-messages.support', compact('mensajes'))->render(),
        ], Response::HTTP_CREATED);   
    }
    public function delete(WebSupportMessage $support){
        $support->delete();
        
        return response()->json([
        ], Response::HTTP_CREATED);    
    }
}
