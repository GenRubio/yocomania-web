<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tweets\WebTweet;

class TweetsUsuario extends Component
{
    public $usuario;
    public $tweetsUsuario;
    public $amount = 20;

    public function render()
    {
        $this->tweetsUsuario = WebTweet::where('usuario_id', $this->usuario)
        ->orderByDesc('id')
        ->take($this->amount)
        ->get();
        return view('livewire.tweets-usuario');
    }
    public function load(){
        $this->amount += 20;
    }
}
