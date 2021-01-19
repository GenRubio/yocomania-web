<?php

namespace App\Http\Livewire;
use App\Models\Tweets\WebTweet;

use Livewire\Component;

class TweetsDelete extends Component
{
    public $tweetsUsuario;  
    public $amount = 20;

    protected $listeners = ['render'];
    public function render()
    {
        $this->emitTo('tweets-comunicado', 'render');

        $this->tweetsUsuario = WebTweet::where('usuario_id', auth()->user()->id)
        ->orderByDesc('id')
        ->take($this->amount)
        ->get();
        return view('livewire.tweets-delete');
    }
    public function eliminar($id){
        WebTweet::where('id', $id)
        ->where('usuario_id', auth()->user()->id)
        ->delete();
    }
    public function load(){
        $this->amount += 20;
    }
}
