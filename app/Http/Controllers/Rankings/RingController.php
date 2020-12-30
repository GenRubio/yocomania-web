<?php

namespace App\Http\Controllers\Rankings;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class RingController extends Controller
{
    public function ringSemanalSilverTops(Request $request){
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('rankings.id_ranking', 1)
            ->where('rankings.tipo_ranking', 1)
            ->orderBy('rankings.puntos', 'DESC')
            ->limit(3)
            ->get();
        $silver_ring = true;
        $usuarios = $busqueda;
        $content = view('components.dashboard.rankings.composer.rankingTops', compact('usuarios', 'silver_ring'))->render();

        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function ringSemanalSilver(Request $request)
    {
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('usuarios.nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('rankings.id_ranking', 1)
            ->where('rankings.tipo_ranking', 1)
            ->orderBy('rankings.puntos', 'DESC')
            ->get();

        $rings_ganados = true;
        if (count($busqueda) == 0) {
            $busqueda = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 1)
                ->where('rankings.tipo_ranking', 1)
                ->orderBy('rankings.puntos', 'DESC')
                ->get();

            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'rings_ganados'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 1)
                ->where('rankings.tipo_ranking', 1)
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
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'searchLive', 'rings_ganados'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function ringSemanalGoldenTops(Request $request)
    {
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('rankings.id_ranking', 1)
            ->where('rankings.tipo_ranking', 2)
            ->orderBy('rankings.puntos', 'DESC')
            ->limit(3)
            ->get();
        $golden_ring = true;
        $usuarios = $busqueda;
        $content = view('components.dashboard.rankings.composer.rankingTops', compact('usuarios', 'golden_ring'))->render();

        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function ringGlobal(Request $request)
    {
        $busqueda = Usuario::where('nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('rings_ganados', '>', 0)
            ->orderBy('rings_ganados', 'DESC')
            ->get();
        $rings_ganados = true;

        if (count($busqueda) == 0) {
            $busqueda = Usuario::orderBy('rings_ganados', 'DESC')
                ->where('rings_ganados', '>', 0)
                ->get();
            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'rings_ganados'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = Usuario::orderBy('rings_ganados', 'DESC')
                ->where('rings_ganados', '>', 0)
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
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'rings_ganados', 'searchLive'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function ringSemanalGolden(Request $request)
    {
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('usuarios.nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('rankings.id_ranking', 1)
            ->where('rankings.tipo_ranking', 2)
            ->orderBy('rankings.puntos', 'DESC')
            ->get();

        $rings_ganados = true;
        if (count($busqueda) == 0) {
            $busqueda = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 1)
                ->where('rankings.tipo_ranking', 2)
                ->orderBy('rankings.puntos', 'DESC')
                ->get();

            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'rings_ganados'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 1)
                ->where('rankings.tipo_ranking', 2)
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
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'searchLive', 'rings_ganados'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
}
