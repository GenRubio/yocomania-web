<?php

namespace App\Http\Livewire;
use App\Models\Tweets\WebTweet;

use Livewire\Component;

class TweetsDelete extends Component
{
    public $tweetsUsuario;
    protected $listeners = ['render'];
    public function render()
    {
        $this->tweetsUsuario = WebTweet::where('usuario_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get();
        return view('livewire.tweets-delete');
    }
    public function eliminar($id){
        WebTweet::where('id', $id)
        ->where('usuario_id', auth()->user()->id)
        ->delete();
    }
}
