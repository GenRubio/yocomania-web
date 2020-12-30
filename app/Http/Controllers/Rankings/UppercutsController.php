<?php

namespace App\Http\Controllers\Rankings;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UppercutsController extends Controller
{
    public function uppercutsEnviadosRanking(Request $request)
    {
        $busqueda = Usuario::where('nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('uppers_enviados', '>', 0)
            ->orderBy('uppers_enviados', 'DESC')
            ->get();
        $uppers_enviados = true;

        if (count($busqueda) == 0) {
            $busqueda = Usuario::orderBy('uppers_enviados', 'DESC')
                ->where('uppers_enviados', '>', 0)
                ->get();
            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'uppers_enviados'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = Usuario::orderBy('uppers_enviados', 'DESC')
                ->where('uppers_enviados', '>', 0)
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
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'uppers_enviados', 'searchLive'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function uppercutsSemanalRanking(Request $request)
    {
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('usuarios.nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('rankings.id_ranking', 5)
            ->where('rankings.tipo_ranking', -1)
            ->orderBy('rankings.puntos', 'DESC')
            ->get();

        $uppers_enviados = true;

        if (count($busqueda) == 0) {
            $busqueda = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 5)
                ->where('rankings.tipo_ranking', -1)
                ->orderBy('rankings.puntos', 'DESC')
                ->get();

            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'uppers_enviados'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 5)
                ->where('rankings.tipo_ranking', -1)
                ->orderBy('rankings.puntos', 'DESC')
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
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'searchLive', 'uppers_enviados'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function uppercutsSemanalTops()
    {
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('rankings.id_ranking', 5)
            ->where('rankings.tipo_ranking', -1)
            ->orderBy('rankings.puntos', 'DESC')
            ->limit(3)
            ->get();
        $upper_semanal = true;
        $usuarios = $busqueda;
        $content = view('components.dashboard.rankings.composer.rankingTops', compact('usuarios', 'upper_semanal'))->render();

        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
}
