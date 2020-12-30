<?php

namespace App\Http\Controllers\Rankings;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SenderoOcultoController extends Controller
{
    public function senderoOcultoGlobal(Request $request)
    {
        $busqueda = Usuario::where('nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('senderos_ganados', '>', 0)
            ->orderBy('senderos_ganados', 'DESC')
            ->get();
        $senderos_ganados = true;

        if (count($busqueda) == 0) {
            $busqueda = Usuario::orderBy('senderos_ganados', 'DESC')
                ->where('senderos_ganados', '>', 0)
                ->get();
            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'senderos_ganados'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = Usuario::orderBy('senderos_ganados', 'DESC')
                ->where('senderos_ganados', '>', 0)
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
            $content = view('components.dashboard.rankings.composer.rankingTbody', compact('usuarios', 'senderos_ganados', 'searchLive'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function senderoOcultoSemanal(Request $request)
    {
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('usuarios.nombre', 'like', ('%' . $request->get('query') . '%'))
            ->where('rankings.id_ranking', 3)
            ->where('rankings.tipo_ranking', 2)
            ->orderBy('rankings.puntos', 'DESC')
            ->get();

        $senderos_ganados = true;
        if (count($busqueda) == 0) {
            $busqueda = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 3)
                ->where('rankings.tipo_ranking', 2)
                ->orderBy('rankings.puntos', 'DESC')
                ->get();

            $usuarios = $busqueda;
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'senderos_ganados'))->render();
        } else {
            $usuarios = array();
            $searchLive = true;
            $todasPersonas = DB::table('usuarios')
                ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
                ->where('rankings.id_ranking', 3)
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
            $content = view('components.dashboard.rankings.composer.rankingTbodySemanal', compact('usuarios', 'searchLive', 'senderos_ganados'))->render();
        }
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function senderoSemanalTops(Request $request)
    {
        $busqueda = DB::table('usuarios')
            ->join('rankings', 'usuarios.id', '=', 'rankings.id_usuario')
            ->where('rankings.id_ranking', 3)
            ->where('rankings.tipo_ranking', 2)
            ->orderBy('rankings.puntos', 'DESC')
            ->limit(3)
            ->get();
        $sendero_oculto = true;
        $usuarios = $busqueda;
        $content = view('components.dashboard.rankings.composer.rankingTops', compact('usuarios', 'sendero_oculto'))->render();

        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
}
