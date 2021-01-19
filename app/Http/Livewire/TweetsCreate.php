<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tweets\WebTweet;

class TweetsCreate extends Component
{
    public $tweetsYocomania;
    public $comentario;
    public $tipoTweet = "1";
    public $amount = 20;

    protected $listeners = ['render'];
    public function render()
    {
        $this->emitTo('tweets-delete', 'render');
        $this->emitTo('tweets-comunicado', 'render');
        $this->tweetsYocomania = WebTweet::whereIn('usuario_id', function($query){
            $query->select('ID_2')
            ->from('bpad_amigos')
            ->where('ID_1', auth()->user()->id);
        })
        ->orWhere('usuario_id', auth()->user()->id)
        ->orWhere('comunicado', 1)
        ->orderByDesc('id')
        ->take($this->amount)
        ->get();
        return view('livewire.tweets-create');
    }
    public function publicar(){
        $tweet = new WebTweet();
        if (auth()->user()->admin == 1){
            if ($this->tipoTweet == "1"){
                $tweet->usuario_id = auth()->user()->id;
                $tweet->tweet = $this->comentario;
                $tweet->likes = 0;
            }
            else{
                $tweet->usuario_id = auth()->user()->id;
                $tweet->tweet = $this->comentario;
                $tweet->comunicado = 1;
                $tweet->likes = 0;

                $this->tipoTweet = "1";
            }
        }
        else{
            $tweet->usuario_id = auth()->user()->id;
            $tweet->tweet = $this->comentario;
            $tweet->likes = 0;
        }
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
    public function load(){
        $this->amount += 20;
    }
}
