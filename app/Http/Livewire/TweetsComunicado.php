<?php

namespace App\Http\Livewire;

use App\Models\Tweets\WebTweet;
use Livewire\Component;

class TweetsComunicado extends Component
{
    public $comunicados;
    public $amount = 20;

    protected $listeners = ['render'];
    public function render()
    {
        $this->comunicados = WebTweet::where('comunicado', 1)
        ->orderByDesc('id')
        ->take($this->amount)
        ->get();
        return view('livewire.tweets-comunicado');
    }
    public function load(){
        $this->amount += 20;
    }
}
