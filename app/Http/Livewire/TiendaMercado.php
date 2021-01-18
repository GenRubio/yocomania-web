<?php

namespace App\Http\Livewire;

use App\Models\Objeto;
use App\Models\ObjetosComprado;
use App\Models\Usuario;
use App\Models\WebObjetosVenta;
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
    public function eliminar($id){
        $venta = WebObjetosVenta::where('id', $id)
        ->where('usuario_id', auth()->user()->id)
        ->first();
        if ($venta != null){
            ObjetosComprado::where('id', $venta->compra_id)
            ->where('usuario_id', auth()->user()->id)
            ->where('active', 0)
            ->update(['active' => 1]);

            WebObjetosVenta::where('id', $id)
            ->delete();
        }
    }
    public function comprar($id){
        if (auth()->user()->Online == 1){
            return;
        }

        $venta = WebObjetosVenta::where('id', $id)
        ->first();
        if ($venta != null){
            if ($venta->oro > 0){
                if (auth()->user()->oro < $venta->oro){
                    return;
                }
                else{
                    Usuario::where('id', auth()->user()->id)
                    ->update(['oro' => auth()->user()->oro - $venta->oro]);
                }
            }
            else{
                if (auth()->user()->plata < $venta->plata){
                    return;
                }
                else{
                    Usuario::where('id', auth()->user()->id)
                    ->update(['plata' => auth()->user()->plata - $venta->plata]);
                }
            }

            ObjetosComprado::where('id', $venta->compra_id)
            ->where('usuario_id', $venta->usuario_id)
            ->where('active', 0)
            ->update(['active' => 1, 'usuario_id' => auth()->user()->id]);

            WebObjetosVenta::where('id', $id)
            ->delete();
        }
    }
}
