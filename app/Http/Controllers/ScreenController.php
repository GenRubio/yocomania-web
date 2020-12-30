<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScreenRequest;
use App\Models\WebImage;
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
}
