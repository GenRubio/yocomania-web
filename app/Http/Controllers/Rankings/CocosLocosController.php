<?php

namespace App\Http\Controllers\Rankings;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CocosLocosController extends Controller
{
    public function cocosLocosGlobal(Request $request){
        $busqueda = Usuario::where('nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('puntos_cocos', '>', 0)
            ->orderBy('puntos_cocos', 'DESC')
            ->get();
        $puntos_cocos = true;

        if (count($busqueda) == 0) {
            $busqueda = Usuario::orderBy('puntos_cocos', 'DESC')
                ->where('puntos_cocos', '>', 0)
                ->get();
            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'puntos_cocos'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = Usuario::orderBy('puntos_cocos', 'DESC')
                ->where('puntos_cocos', '>', 0)
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
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'puntos_cocos', 'searchLive'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function cocosLocosSemanalGolden(Request $request){
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('usuarios.nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('rankings.id_ranking', 2)
            ->where('rankings.tipo_ranking', 2)
            ->orderBy('rankings.puntos', 'DESC')
            ->get();

        $puntos_cocos = true;
        if (count($busqueda) == 0) {
            $busqueda = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 2)
                ->where('rankings.tipo_ranking', 2)
                ->orderBy('rankings.puntos', 'DESC')
                ->get();

            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'puntos_cocos'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 2)
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
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'searchLive', 'puntos_cocos'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function cocosLocosSemanalGoldenTops(Request $request){
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('rankings.id_ranking', 2)
            ->where('rankings.tipo_ranking', 2)
            ->orderBy('rankings.puntos', 'DESC')
            ->limit(3)
            ->get();
        $golden_cocos = true;
        $usuarios = $busqueda;
        $content = view('components.dashboard.rankings.composer.rankingTops', compact('usuarios', 'golden_cocos'))->render();

        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function cocosLocosSemanalSilver(Request $request){
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('usuarios.nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('rankings.id_ranking', 2)
            ->where('rankings.tipo_ranking', 1)
            ->orderBy('rankings.puntos', 'DESC')
            ->get();
        $puntos_cocos = true;
        if (count($busqueda) == 0) {
            $busqueda = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 2)
                ->where('rankings.tipo_ranking', 1)
                ->orderBy('rankings.puntos', 'DESC')
                ->get();

            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'puntos_cocos'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 2)
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
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'searchLive', 'puntos_cocos'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function cocosLocosSemanalSilverTops(Request $request){
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('rankings.id_ranking', 2)
            ->where('rankings.tipo_ranking', 1)
            ->orderBy('rankings.puntos', 'DESC')
            ->limit(3)
            ->get();
        $silver_cocos = true;
        $usuarios = $busqueda;
        $content = view('components.dashboard.rankings.composer.rankingTops', compact('usuarios', 'silver_cocos'))->render();

        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
}
