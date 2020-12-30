<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\WebSupport;
use App\Models\WebSupportMessage;
use Illuminate\Http\Response;

class AdminSupportController extends Controller
{
    public function get()
    {
        $supports = WebSupport::orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'content' => view('adminDashboard.components.support-messages', compact('supports'))->render(),
        ], Response::HTTP_CREATED);
    }
    public function sendOne(Request $request)
    {
        $supportMensaje = new WebSupportMessage();
        $supportMensaje->id_usuario = $request->get('usuario');
        $supportMensaje->subject = $request->get('subject');
        $supportMensaje->contenido = $request->get('supportMensaje');
        $supportMensaje->save();

        return response()->json([
            'content' => "Mensaje ha sido enviado",
        ], Response::HTTP_CREATED);
    }
    public function delete(WebSupport $support)
    {
        $support->delete();

        return response()->json([], Response::HTTP_CREATED);
    }
    public function send(Request $request)
    {
        $output = "todos";
        $subject = $request->get('redactSubject');
        $texto = $request->get('redactTexto');

        if ($request->get('redactTipo') == "one") {
            $usuario = Usuario::where('nombre', $request->get('redactUsuario'))->first();
            if ($usuario != null) {
                $support = new WebSupportMessage();
                $support->id_usuario = $usuario->id;
                $support->subject = $subject;
                $support->contenido = $texto;
                $support->save();

                $output = $usuario->nombre;
            }
        } else {
            $inserts = [];
            $bids = Usuario::get();
            foreach($bids as $bid) {
                $inserts[] = [ 'id_usuario' => $bid->id,
                       'subject' => $subject, 
                       'contenido' => $texto]; 
            }
            WebSupportMessage::insert($inserts);
        }
        return response()->json([
            'content' => "Se ha enviado mensaje a " . $output,
        ], Response::HTTP_CREATED);
    }
}
