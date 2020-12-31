<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScreenRequest;
use App\Models\CodigosPromocionale;
use App\Models\WebImage;
use App\Models\WebSupportMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScreenController extends Controller
{
    public function create(ScreenRequest $request){
        if (auth()->user()->admin > 0){
            $screen = new WebImage();
            $screen->descripcion = str_replace("'", '"', $request->get('descripcionScreen'));

            if ($request->hasFile('imagenScreen')) {
                $image = $request->file('imagenScreen');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("images/screenshots"), $new_name);
                $screen->link = '/images/screenshots/' . $new_name;
            } else {
                $screen->link = '';
            }
            
            $screen->active = 1;
            $screen->tipo = 1;
            $screen->save();
        }
        return response()->json([
            'result' => 'Se ha publicado nuevo Screenshot.',
        ], Response::HTTP_CREATED);      
    }
    public function getCreatorContent(){
        $contenidos = WebImage::where('tipo', 1)
        ->where('active', 0)
        ->orderBy('id', 'DESC')
        ->get();

        $content = view('adminDashboard.components.creator-screen', compact('contenidos'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function addCreatorContent(Request $request){
        WebImage::where('user_id', $request->get('usuarioId'))
        ->where('id', $request->get('screenId'))
        ->where('active', 0)
        ->update(['active' => 1]);

        $codigo = rand(100000000,999999999);

        $codigoPromocional = new CodigosPromocionale();
        $codigoPromocional->codigo = $codigo;
        $codigoPromocional->oro = 250;
        $codigoPromocional->user_id = $request->get('usuarioId');
        $codigoPromocional->save();

        $sopportMenssage = new WebSupportMessage();
        $sopportMenssage->id_usuario = $request->get('usuarioId');
        $sopportMenssage->subject = "Screenshot aceptado :D";
        $sopportMenssage->contenido = "Gracias por ayudar a Yocomania a crecer. Hemos aceptado tu Screenshot 
        , puedes encontrar to Screenshot publicado en el apartador de Screenshots en la parte principal de la pagina. 
        Para obtener tu recompensa cangea el siguente codigo dentro de Yocomania dando click en la parte de los Créditos.
                          Codigo: " . $codigo;
        $sopportMenssage->save();

        return response()->json([
        ], Response::HTTP_CREATED);
    }
    public function deleteCreatorContent(Request $request){
        WebImage::where('user_id', $request->get('usuarioId'))
        ->where('id', $request->get('screenId'))
        ->delete();

        return response()->json([
        ], Response::HTTP_CREATED);
    }
}
