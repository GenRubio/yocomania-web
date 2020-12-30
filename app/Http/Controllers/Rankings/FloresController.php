<?php

namespace App\Http\Controllers\Rankings;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FloresController extends Controller
{
    public function floresEnviadosRanking(Request $request)
    {
        $busqueda = Usuario::where('nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('flores_enviadas', '>', 0)
            ->orderBy('flores_enviadas', 'DESC')
            ->get();
        $flores_enviadas = true;

        if (count($busqueda) == 0) {
            $busqueda = Usuario::orderBy('flores_enviadas', 'DESC')
                ->where('flores_enviadas', '>', 0)
                ->get();
            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'flores_enviadas'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = Usuario::orderBy('flores_enviadas', 'DESC')
                ->where('flores_enviadas', '>', 0)
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
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'flores_enviadas', 'searchLive'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function floresRecibidosRanking(Request $request)
    {
        $busqueda = Usuario::where('nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('flores_recibidas', '>', 0)
            ->orderBy('flores_recibidas', 'DESC')
            ->get();
        $flores_recibidas = true;

        if (count($busqueda) == 0) {
            $busqueda = Usuario::orderBy('flores_recibidas', 'DESC')
                ->where('flores_recibidas', '>', 0)
                ->get();
            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'flores_recibidas'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = Usuario::orderBy('flores_recibidas', 'DESC')
                ->where('flores_recibidas', '>', 0)
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
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'flores_recibidas', 'searchLive'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
}
