<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebImage;
use App\Http\Requests\ScreenhotCreatorRequest;
use App\Http\Requests\FanartCreatorRequest;
use App\Http\Requests\YoutubeCreatorRequest;
use App\Models\WebEvento;
use Illuminate\Http\Response;

class CreadorContenidoController extends Controller
{
    public function createScreenshot(ScreenhotCreatorRequest $request)
    {
        $screen = new WebImage();
        $screen->descripcion = str_replace("'", '"', $request->get('textScreen'));

        if ($request->hasFile('imgScreen')) {
            $image = $request->file('imgScreen');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("images/screenshots"), $new_name);
            $screen->link = '/images/screenshots/' . $new_name;
        } else {
            $screen->link = '';
        }
        $screen->user_id = auth()->user()->id;
        $screen->tipo = 1;
        $screen->save();

        return response()->json([
            'content' => 'Imagen enviada correctamente.',
        ], Response::HTTP_CREATED);
    }
    public function createFanart(FanartCreatorRequest $request){
        $screen = new WebImage();
        $screen->descripcion = str_replace("'", '"', $request->get('textFanart'));

        if ($request->hasFile('imgFanart')) {
            $image = $request->file('imgFanart');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("images/fanart"), $new_name);
                $screen->link = '/images/fanart/' . $new_name;
        } else {
            $screen->link = '';
        }
        $screen->user_id = auth()->user()->id;
        $screen->tipo = 2;
        $screen->save();

        return response()->json([
            'content' => 'Imagen enviada correctamente.',
        ], Response::HTTP_CREATED);
    }
    public function createYoutube(YoutubeCreatorRequest $request){
        $link = $request->get('videoYoutube');
        if (strpos($link, 'https://youtu.be/') !== false) {
            $link = str_replace("https://youtu.be/", "https://www.youtube.com/embed/", $link);
        }
        else{
            return back();
        }
        $evento = new WebEvento();
        $evento->link = $link;
        $evento->tipo = 1;
        $evento->user_id = auth()->user()->id;
        $evento->save();

        return response()->json([
            'content' => 'Link enviado correctamente.',
        ], Response::HTTP_CREATED);
    }
}
