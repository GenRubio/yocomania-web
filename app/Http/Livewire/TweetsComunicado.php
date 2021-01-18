<?php

namespace App\Http\Livewire;

use App\Models\Tweets\WebTweet;
use Livewire\Component;

class TweetsComunicado extends Component
{
    public $comunicados;
    public function render()
    {
        $this->comunicados = WebTweet::where('comunicado', 1)
        ->orderByDesc('id')
        ->get();
        return view('livewire.tweets-comunicado');
    }
}
