<?php

namespace App\Http\Controllers\Tienda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function show(){
        return view('components.dashboard.tienda');
    }
}
