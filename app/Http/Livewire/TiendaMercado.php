<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TiendaMercado extends Component
{
    public function render()
    {
        $objetos = DB::table('web_objetos_ventas')
            ->join('objetos', 'objetos.id', '=', 'web_objetos_ventas.objeto_id')
            ->select('web_objetos_ventas.id','web_objetos_ventas.compra_id','web_objetos_ventas.usuario_id', 'web_objetos_ventas.objeto_id', 'web_objetos_ventas.oro', 'web_objetos_ventas.plata', 'objetos.swf', 'objetos.img', 'objetos.titulo')
            ->where('usuario_id', auth()->user()->id)
            ->get();

        return view('livewire.tienda-mercado', compact('objetos'));
    }
}
