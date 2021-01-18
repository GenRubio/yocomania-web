<?php

namespace App\Http\Livewire;

use App\Models\Tweets\WebTweet;
use Livewire\Component;

class Tweets extends Component
{
    public $tweetsYocomania;
    public $comentario;
    public function render()
    {
        $this->emitTo('tweets-delete', 'render');
        return view('livewire.tweets');
    }
    public function publicar(){
        $tweet = new WebTweet();
        $tweet->usuario_id = auth()->user()->id;
        $tweet->tweet = $this->comentario;
        $tweet->likes = 0;
        $tweet->save();

        $this->comentario = "";
    }
}
