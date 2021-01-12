<?php

namespace App\Http\Controllers\Tienda;

use App\Http\Controllers\Controller;
use App\Models\PagosPendiente;
use Illuminate\Http\Request;

class PagosConstroller extends Controller
{
    public function comprobar(){
        //Borrar pagos
        PagosPendiente::where('usuario_id', auth()->user()->id)->delete();

        

        return redirect()->route('show.tienda');
    }
}
