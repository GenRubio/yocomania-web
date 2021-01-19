<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tweets\WebTweet;
use App\Models\Tweets\WebTweetsLike;

class TweetsCreate extends Component
{
    public $tweetsYocomania;
    public $comentario;
    public $tipoTweet = "1";
    public $amount = 20;
    public $usuarioLikes;

    protected $listeners = ['render'];
    public function render()
    {
        $this->emitTo('tweets-delete', 'render');
        $this->emitTo('tweets-comunicado', 'render');
        
        $usuarioLikes = WebTweetsLike::where('usuario_id', auth()->user()->id)
        ->get();
        $array = [];
        foreach($usuarioLikes as $like){
            array_push($array, $like->tweet_id);
        }
        $this->usuarioLikes = $array;

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
    public function like($id){
        $comprobarLike = WebTweetsLike::where('usuario_id', auth()->user()->id)
        ->where('tweet_id', $id)
        ->first();
        if ($comprobarLike == null){
            $like = new WebTweetsLike();
            $like->usuario_id = auth()->user()->id;
            $like->tweet_id = $id;
            $like->save();
            
            WebTweet::where('id', $id)
            ->increment('likes' , 1);
        }
    }
}
