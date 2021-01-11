<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TiendaCreditos extends Component
{
    public function render()
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51I7cy4I5NFYJjszO8insCyuqDmhlvKsoZkUTKYrOHI3qz1uEaK7grAvdxLj8ArWH4lJ705C35Mrq7n8Nrz8qrFzS00yp09BVAe'
        );
        $productos = $stripe->products->all();
        return view('livewire.tienda-creditos', compact('productos'));
    }
}
