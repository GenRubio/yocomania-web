<?php

namespace App\Http\Livewire;

use App\Models\WebTiendaCredito;
use Illuminate\Http\Request;
use Livewire\Component;

class CrearProducto extends Component
{
    public $nombre;
    public $precio = 0;
    public function render()
    {
        return view('livewire.crear-producto');
    }
    public function crear(Request $request)
    {
        $this->validate([
            'nombre' => 'required',
            'precio' => 'required',
        ]);

        $stripe = new \Stripe\StripeClient(
            'sk_test_51I7cy4I5NFYJjszO8insCyuqDmhlvKsoZkUTKYrOHI3qz1uEaK7grAvdxLj8ArWH4lJ705C35Mrq7n8Nrz8qrFzS00yp09BVAe'
        );
        $producto = $stripe->products->create([
            'name' => $this->nombre,
            'metadata' => [
                'precio' => $this->precio,
            ]
        ]);
        $stripe->prices->create([
            'unit_amount' => $this->precio * 100,
            'currency' => 'eur',
            'product' => $producto->id,
        ]);

        $oferta = new WebTiendaCredito();
        $oferta->token = $producto->id;
        $oferta->precio = $this->precio;
        $oferta->nombre = $this->nombre;
        $oferta->save();

        session()->flash('success', 'Producto creado.');

        $this->nombre = "";
        $this->precio = 0;
    }
}
