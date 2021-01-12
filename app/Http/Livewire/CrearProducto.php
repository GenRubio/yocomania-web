<?php

namespace App\Http\Livewire;

use App\Models\WebTiendaCredito;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearProducto extends Component
{
    public $nombre;
    public $precio = 0;
    public $image;
    public $creditos;

    use WithFileUploads;
    public function render()
    {
        return view('livewire.crear-producto');
    }
    
    public function crear(Request $request)
    {
        $this->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'creditos' => 'required',
        ]);

        $stripe = new \Stripe\StripeClient(
            'sk_test_51I7cy4I5NFYJjszO8insCyuqDmhlvKsoZkUTKYrOHI3qz1uEaK7grAvdxLj8ArWH4lJ705C35Mrq7n8Nrz8qrFzS00yp09BVAe'
        );
        $producto = $stripe->products->create([
            'name' => $this->nombre,
            'images' => [],
            'metadata' => [
                'precio' => $this->precio,
            ]
        ]);
        $compra = $stripe->prices->create([
            'unit_amount' => $this->precio * 100,
            'currency' => 'eur',
            'product' => $producto->id,
        ]);
        //Cargar la imagen
        /*\Stripe\Stripe::setApiKey('sk_test_51I7cy4I5NFYJjszO8insCyuqDmhlvKsoZkUTKYrOHI3qz1uEaK7grAvdxLj8ArWH4lJ705C35Mrq7n8Nrz8qrFzS00yp09BVAe');
        $fp = fopen('storage/' . $url , 'r');
        \Stripe\File::create([
            'file' => $fp,
            'purpose' => 'dispute_evidence',
        ]);*/

        $oferta = new WebTiendaCredito();
        $oferta->token = $compra->id;
        $oferta->precio = $this->precio . ",00 €";
        $oferta->nombre = $this->nombre;
        $oferta->descripcion = $this->creditos;
        $oferta->save();

        session()->flash('success', 'Producto creado.');

        $this->nombre = "";
        $this->precio = "0";
        $this->image = "";
    }
}
