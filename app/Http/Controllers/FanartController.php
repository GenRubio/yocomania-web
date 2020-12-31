<?php

namespace App\Http\Controllers;

use App\Http\Requests\FanartRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CodigosPromocionale;
use App\Models\WebSupportMessage;
use App\Models\WebImage;

class FanartController extends Controller
{
    public function create(FanartRequest $request){
        if (auth()->user()->admin > 0){
            $screen = new WebImage();
            $screen->descripcion = str_replace("'", '"', $request->get('descripcionFanart'));

            if ($request->hasFile('imagenFanart')) {
                $image = $request->file('imagenFanart');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("images/fanart"), $new_name);
                $screen->link = '/images/fanart/' . $new_name;
            } else {
                $screen->link = '';
            }
            
            $screen->active = 1;
            $screen->tipo = 2;
            $screen->save();
        }
        return response()->json([
            'result' => 'Se ha publicado nuevo FanArt.',
        ], Response::HTTP_CREATED);      
    }
    public function getCreatorContent(){
        $contenidos = WebImage::where('tipo', 2)
        ->where('active', 0)
        ->orderBy('id', 'DESC')
        ->get();

        $content = view('adminDashboard.components.creator-fanart', compact('contenidos'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function addCreatorContent(Request $request){
        WebImage::where('user_id', $request->get('usuarioId'))
        ->where('id', $request->get('fanartId'))
        ->where('active', 0)
        ->update(['active' => 1]);

        $codigo = rand(100000000,999999999);

        $codigoPromocional = new CodigosPromocionale();
        $codigoPromocional->codigo = $codigo;
        $codigoPromocional->oro = 2000;
        $codigoPromocional->user_id = $request->get('usuarioId');
        $codigoPromocional->save();

        $sopportMenssage = new WebSupportMessage();
        $sopportMenssage->id_usuario = $request->get('usuarioId');
        $sopportMenssage->subject = "FanArt aceptado :D";
        $sopportMenssage->contenido = "Gracias por ayudar a Yocomania a crecer. Hemos aceptado tu FanArt
        , puedes encontrar el FanArt publicado en el apartador de FanArt en la parte principal de la página.
        Para obtener tu recompensa canjea el siguiente código dentro de Yocomania dando clic en la parte de los Créditos.
        Código: " . $codigo;
        $sopportMenssage->save();

        return response()->json([
        ], Response::HTTP_CREATED);
    }
    public function deleteCreatorContent(Request $request){
        WebImage::where('user_id', $request->get('usuarioId'))
        ->where('id', $request->get('fanartId'))
        ->delete();

        return response()->json([
        ], Response::HTTP_CREATED);
    }
}
