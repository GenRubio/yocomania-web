<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebContacto;

class AdminContactController extends Controller
{
    public function index(){
        $mensajesContacto = WebContacto::where('activo', 1);
    }
}
