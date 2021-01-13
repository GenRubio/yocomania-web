<?php

namespace App\Http\Livewire;

use App\Models\Noticia;
use Intervention\Image\ImageManager;
use Livewire\Component;
use PHPUnit\Framework\Error\Notice;
use Livewire\WithFileUploads;

class CreateNoticia extends Component
{
    use WithFileUploads;

    public $titulo;
    public $descripcion;
    public $imagen;

    public function render()
    {
        return view('livewire.create-noticia');
    }
    public function create(){
        $this->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        $noticia = new Noticia();
        $noticia->titulo = $this->titulo;
        $noticia->contenido = $this->descripcion;
        $noticia->fecha =  date('d-m-Y');
        if (!empty($this->imagen)){
            $imageHashName = $this->imagen->hashName();
            $this->imagen->store('public/noticias');

            $manager = new ImageManager();
            $image = $manager->make('storage/noticias/' . $imageHashName);
            $image->save('images/noticias/' . $imageHashName);
            $noticia->image = 'images/noticias/' . $imageHashName;
        }
        $noticia->save();

        session()->flash('success', 'Nueva noticia creada.');

        $this->titulo = "";
        $this->descripcion = "";
        $this->imagen = "";
    }
}
