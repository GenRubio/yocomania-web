<?php

namespace App\Http\Controllers\Rankings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Usuario;

class ForbesController extends Controller
{
    public function forbesGlobal(Request $request){
        $busqueda = Usuario::where('nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('oro', '>', 100000)
            ->orderBy('oro', 'DESC')
            ->get();
        $oro = true;

        if (count($busqueda) == 0) {
            $busqueda = Usuario::orderBy('oro', 'DESC')
                ->where('oro', '>', 100000)
                ->get();
            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'oro'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = Usuario::orderBy('oro', 'DESC')
                ->where('oro', '>', 100000)
                ->get();
            foreach ($todasPersonas as $key => $user) {
                foreach ($busqueda as $b) {
                    if ($user->id == $b->id) {
                        $llave = $key + 1;
                        $usuarios[$llave] = $b;
                        break;
                    }
                }
            }
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'oro', 'searchLive'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
}
