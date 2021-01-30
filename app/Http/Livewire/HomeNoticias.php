<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Noticia;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class HomeNoticias extends Component
{
    use WithPagination;
    public $currentPage = 1;
    public function render()
    {
        return view('livewire.home-noticias', [
            'noticias' =>  Noticia::orderBy('id', 'DESC')->paginate(10),
        ]);
    }
    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
    }
}
