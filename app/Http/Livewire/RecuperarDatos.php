<?php

namespace App\Http\Livewire;

use App\Http\Requests\RecuperarDatosRequest;
use App\Models\TicketRecuperacionCuenta;
use Livewire\Component;
use Illuminate\Http\Request;

class RecuperarDatos extends Component
{
    public $nombre;
    public $password;
    public $clave;
    public function render()
    {
        return view('livewire.recuperar-datos');
    }
    public function crearSolicitud(Request $request){

        $this->validate([
            'nombre' => 'required',
            'password' => 'required',
        ]);

        $comprobarRegistro = TicketRecuperacionCuenta::where('usuario_id', auth()->user()->id)
        ->where('nombre', $this->nombre)
        ->where('password', $this->password)
        ->where('clave', $this->clave)
        ->first();
        if($comprobarRegistro != null){
            session()->flash('error', 'Ya tienes una solicitud creada con estos datos.');
        }
        else{
            $ticket = new TicketRecuperacionCuenta();
            $ticket->usuario_id = auth()->user()->id;
            $ticket->usuario_nombre = auth()->user()->nombre;
            $ticket->nombre = $this->nombre;
            $ticket->password = $this->password;
            $ticket->clave = $this->clave;
            $ticket->save();

            session()->flash('success', 'Solicitud enviada correctamente.');
        }

        $this->nombre = "";
        $this->password = "";
        $this->clave = "";
    }
}
