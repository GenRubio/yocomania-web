<?php

namespace App\Http\Controllers\Rankings;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CocosController extends Controller
{
    public function cocosEnviadosRanking(Request $request)
    {
        $busqueda = Usuario::where('nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('cocos_enviados', '>', 0)
            ->orderBy('cocos_enviados', 'DESC')
            ->get();
        $cocos_enviados = true;

        if (count($busqueda) == 0) {
            $busqueda = Usuario::orderBy('cocos_enviados', 'DESC')
                ->where('cocos_enviados', '>', 0)
                ->get();
            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'cocos_enviados'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = Usuario::orderBy('cocos_enviados', 'DESC')
                ->where('cocos_enviados', '>', 0)
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
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'cocos_enviados', 'searchLive'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
}
