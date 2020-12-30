<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RankingsController extends Controller
{
    public function ringRanking()
    {
        $ring = true;
        return view('components.dashboard.rankings', compact('ring'));
    }
    public function senderoRanking()
    {
        $sendero_oculto = true;
        return view('components.dashboard.rankings', compact('sendero_oculto'));
    }
    public function cocosLocosRanking()
    {
        $cocos_locos = true;
        return view('components.dashboard.rankings', compact('cocos_locos'));
    }
    public function caminoNinjaRanking()
    {
        $camino_ninja = true;
        return view('components.dashboard.rankings', compact('camino_ninja'));
    }
    public function besosRanking()
    {
        $besos = true;
        return view('components.dashboard.rankings', compact('besos'));
    }
    public function bebidasRanking()
    {
        $bebidas = true;
        return view('components.dashboard.rankings', compact('bebidas'));
    }
    public function floresRanking()
    {
        $flores = true;
        return view('components.dashboard.rankings', compact('flores'));
    }
    public function uppercutsRanking()
    {
        $uppercuts = true;
        return view('components.dashboard.rankings', compact('uppercuts'));
    }
    public function cocosRanking()
    {
        $cocos = true;
        return view('components.dashboard.rankings', compact('cocos'));
    }
}
