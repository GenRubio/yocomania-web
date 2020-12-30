<?php

namespace App\Http\Controllers;

use App\Http\Requests\YoutubeRequest;
use App\Models\WebEvento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
}
