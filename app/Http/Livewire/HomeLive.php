<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\WebEvento;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class HomeLive extends Component
{
    use WithPagination;
    public $currentPage = 1;
    public function render()
    {
        return view('livewire.home-live', [
            'videos' => WebEvento::orderBy('id', 'DESC')
            ->where('tipo', 1)
            ->where('active', 1)
            ->paginate(4),
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
