<?php

namespace App\Http\Controllers;

use App\Http\Requests\FanartRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
}
