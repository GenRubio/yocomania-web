<?php

namespace App\Http\Controllers\Tienda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function show()
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51I7cy4I5NFYJjszO8insCyuqDmhlvKsoZkUTKYrOHI3qz1uEaK7grAvdxLj8ArWH4lJ705C35Mrq7n8Nrz8qrFzS00yp09BVAe'
        );
        $ids = $stripe->skus->all(['limit' => 3]);
        dd($ids);
        return view('components.dashboard.tienda');
    }
}
