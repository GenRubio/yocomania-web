<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tweets\WebTweet;

class TweetsCreate extends Component
{
    public $tweetsYocomania;
    public $comentario;

    protected $listeners = ['render'];
    public function render()
    {
        $this->emitTo('tweets-delete', 'render');
        $this->tweetsYocomania = WebTweet::whereIn('usuario_id', function($query){
            $query->select('ID_2')
            ->from('bpad_amigos')
            ->where('ID_1', auth()->user()->id);
        })
        ->orWhere('usuario_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get();
        return view('livewire.tweets-create');
    }
    public function publicar(){
        $tweet = new WebTweet();
        $tweet->usuario_id = auth()->user()->id;
        $tweet->tweet = $this->comentario;
        $tweet->likes = 0;
        $tweet->save();

        $this->comentario = "";
    }
    public function eliminar($id){
        $tweet = WebTweet::where('id', $id)->first();
        if ($tweet != null){
            if ($tweet->usuario_id == auth()->user()->id){
                $tweet->delete();
            }
        }
    }
}
