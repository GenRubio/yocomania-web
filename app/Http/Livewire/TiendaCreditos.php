<?php

namespace App\Http\Livewire;

use App\Models\PagosPendiente;
use App\Models\WebTiendaCredito;
use Livewire\Component;

class TiendaCreditos extends Component
{
    public function render()
    {
        $productos = WebTiendaCredito::all();
        return view('livewire.tienda-creditos', compact('productos'));
    }
    public function registerTrans($id, $token){
        if ($id == auth()->user()->id){
            $producto = WebTiendaCredito::where('token', $token)
            ->first();
            if ($producto != null){
                $pago = new PagosPendiente();
                $pago->usuario_id = auth()->user()->id;
                $pago->token = $token;
                $pago->cantidad = intval($producto->descripcion);
                $pago->save(); 
            }
            else{
                return back();
            }
        }
    }
}
