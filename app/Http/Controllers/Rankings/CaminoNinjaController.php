<?php

namespace App\Http\Controllers\Rankings;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CaminoNinjaController extends Controller
{
    public function caminoNinjaGlobal(Request $request)
    {
        $busqueda = Usuario::where('nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('puntos_ninja', '>', 0)
            ->orderBy('puntos_ninja', 'DESC')
            ->get();
        $puntos_ninja = true;

        if (count($busqueda) == 0) {
            $busqueda = Usuario::orderBy('puntos_ninja', 'DESC')
                ->where('puntos_ninja', '>', 0)
                ->get();
            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'puntos_ninja'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = Usuario::orderBy('puntos_ninja', 'DESC')
                ->where('puntos_ninja', '>', 0)
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
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'puntos_ninja', 'searchLive'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
}
