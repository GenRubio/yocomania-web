<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TiendaMercado extends Component
{
    public $search;
    public $objetos;
    public $priceMin = 0;
    public $priceMax = 99999;

    public function render()
    {
        $search =   '%' . $this->search . '%';
        $this->objetos = DB::table('web_objetos_ventas')
            ->join('objetos', 'objetos.id', '=', 'web_objetos_ventas.objeto_id')
            ->join('usuarios', 'usuarios.id', '=', 'web_objetos_ventas.usuario_id')
            ->select('web_objetos_ventas.id', 'web_objetos_ventas.compra_id', 
            'web_objetos_ventas.usuario_id', 'web_objetos_ventas.objeto_id', 
            'web_objetos_ventas.oro', 'web_objetos_ventas.plata', 'objetos.swf', 
            'objetos.img', 'objetos.titulo', 'objetos.descripcion', 'objetos.precio_oro', 
            'objetos.precio_plata', 'usuarios.nombre')

            ->where('objetos.titulo', 'like', $search)
            ->where(function ($query) {
                $query ->whereBetween('web_objetos_ventas.oro', [$this->priceMin, $this->priceMax])
                ->orWhereBetween('web_objetos_ventas.plata', [$this->priceMin, $this->priceMax]);
            })
           
            ->orderByDesc('id')
            ->get();
        return view('livewire.tienda-mercado');
    }
}
