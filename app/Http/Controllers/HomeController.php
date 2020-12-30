<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\WebEvento;
use App\Models\WebImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        if (auth()->check()){
            return redirect('me');
        }

        
        $noticias = Noticia::orderBy('id', 'DESC')->paginate(10);
        $videos = WebEvento::orderBy('id', 'DESC')
        ->where('tipo', 1)
        ->paginate(4);
        $videosEvento = WebEvento::orderBy('id', 'DESC')
        ->where('tipo', 1)
        ->paginate(12);
        $eventos = WebEvento::orderBy('fecha', 'ASC')
        ->where('tipo', 2)
        ->paginate(4);
        $screenshots = WebImage::where('active', 1)
        ->where('tipo', 1)
        ->orderBy('id', 'DESC')
        ->paginate(9);
        $fanart = WebImage::where('active', 1)
        ->where('tipo', 2)
        ->orderBy('id', 'DESC')
        ->paginate(9);          
        return view('home', compact('noticias', 'videos', 'eventos', 'videosEvento', 'screenshots', 'fanart'));
    }
}
