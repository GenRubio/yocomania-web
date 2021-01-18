<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tweets extends Component
{
    public function render()
    {
        return view('livewire.tweets');
    }
}
