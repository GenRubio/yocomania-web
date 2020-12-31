<?php

namespace App\Http\Controllers;

use App\Http\Requests\YoutubeRequest;
use App\Models\WebEvento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CodigosPromocionale;
use App\Models\WebSupportMessage;

class YoutubeController extends Controller
{
    public function create(YoutubeRequest $request){
        $link = $request->get('linkYoutube');
        if (strpos($link, 'https://youtu.be/') !== false) {
            $link = str_replace("https://youtu.be/", "https://www.youtube.com/embed/", $link);
        }
        else{
            return back();
        }

        $evento = new WebEvento();
        $evento->link = $link;
        $evento->tipo = 1;
        $evento->active = 1;
        $evento->save();

        return response()->json([
            'result' => 'Se ha agregado nuevo video.',
        ], Response::HTTP_CREATED);      
    }
    public function getCreatorContent(){
        $contenidos = WebEvento::where('tipo', 1)
        ->where('active', 0)
        ->orderBy('id', 'DESC')
        ->get();

        $content = view('adminDashboard.components.creator-youtube', compact('contenidos'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function addCreatorContent(Request $request){
        WebEvento::where('user_id', $request->get('usuarioId'))
        ->where('id', $request->get('youtubeId'))
        ->where('active', 0)
        ->update(['active' => 1]);

        $codigo = rand(100000000,999999999);

        $codigoPromocional = new CodigosPromocionale();
        $codigoPromocional->codigo = $codigo;
        $codigoPromocional->oro = 5000;
        $codigoPromocional->user_id = $request->get('usuarioId');
        $codigoPromocional->save();

        $sopportMenssage = new WebSupportMessage();
        $sopportMenssage->id_usuario = $request->get('usuarioId');
        $sopportMenssage->subject = "Video YouTube aceptado :D";
        $sopportMenssage->contenido = "Gracias por ayudar a Yocomania a crecer. Hemos aceptado tu video de YouTube
        , puedes encontrar el video publicado en el apartador de Eventos en la parte principal de la página.
        Para obtener tu recompensa canjea el siguiente código dentro de Yocomania dando clic en la parte de los Créditos.
        Código: " . $codigo;
        $sopportMenssage->save();

        return response()->json([
        ], Response::HTTP_CREATED);
    }
    public function deleteCreatorContent(Request $request){
        WebEvento::where('user_id', $request->get('usuarioId'))
        ->where('id', $request->get('youtubeId'))
        ->delete();

        return response()->json([
        ], Response::HTTP_CREATED);
    }
}
