<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventosRequest;
use App\Models\WebEvento;
use Illuminate\Http\Response;

class EventosController extends Controller
{
    public function create(EventosRequest $request){

        if (auth()->user()->admin > 0){
            $evento = new WebEvento();
            $evento->nombre = str_replace("'", '"', $request->get('nombre'));
            $evento->titulo = str_replace("'", '"', $request->get('titulo'));
            $evento->descripcion = str_replace("'", '"', $request->get('descripcion'));
            $evento->fecha = $request->get('fecha');
            $evento->tipo = 2;
            if ($request->hasFile('imagen')) {
                $image = $request->file('imagen');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("images/eventos"), $new_name);
                $evento->link = '/images/eventos/' . $new_name;
            } else {
                $evento->link = '';
            }
            $evento->save();
        }
        return response()->json([
            'result' => 'Se ha creado nuevo evento.',
        ], Response::HTTP_CREATED);      
    }
    public function search(){
        $eventos = WebEvento::where('tipo', 2)
        ->orderBy('fecha', 'ASC')
        ->get();
        return response()->json([
            'content' => view('adminDashboard.components.evento', compact('eventos'))->render(),
        ], Response::HTTP_CREATED);      
    }
    public function delete(Request $request){
        WebEvento::where('id', $request->get('eventoId'))->delete();

        return back();
    }
}
