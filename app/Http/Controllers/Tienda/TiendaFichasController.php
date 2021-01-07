<?php

namespace App\Http\Controllers\Tienda;

use App\Http\Controllers\Controller;
use App\Models\ArmarioFicha;
use App\Models\Usuario;
use App\Models\WebTiendaFicha;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TiendaFichasController extends Controller
{
    public function show()
    {
        $fichas = WebTiendaFicha::get();

        return response()->json([
            'content' => view('components.dashboard.tienda._fichas', compact('fichas'))->render(),
        ], Response::HTTP_CREATED);
    }
    public function comprar(Request $request)
    {
        $amigo = $request->get('amigo');
        $fichaId = $request->get('ficha');
        $nombreAmigo = $request->get('nombreAmigo');
        $error = "";
        $ficha = WebTiendaFicha::where('id', '=', $fichaId)->first();
        if ($ficha != null) {
            if (auth()->user()->oro < $ficha->oro) {
                $error = "No tienes créditos suficientes.";
            } else {
                if ($amigo != "") {
                    $buscarAmigo = Usuario::where('nombre', '=', $nombreAmigo)->first();
                    if ($buscarAmigo != null) {
                        $comprobarArmario = ArmarioFicha::where('ficha_id', $ficha->ficha_id)
                            ->where('user_id', $buscarAmigo->id)
                            ->first();
                        if ($comprobarArmario != null) {
                            $error = "Usuario ya tiene comprada esta ficha.";
                        } else {
                            if (auth()->user()->Online == 1) {
                                $error = "Desconectate del juego para realizar esta accion.";
                            } else {
                                Usuario::where('id', auth()->user()->id)
                                    ->update(['oro' => auth()->user()->oro - $ficha->oro]);

                                $newFicha = new ArmarioFicha();
                                $newFicha->user_id = $buscarAmigo->id;
                                $newFicha->ficha_id = $ficha->ficha_id;
                                $newFicha->save();
                            }
                        }
                    } else {
                        $error = "Usuario no encontrado";
                    }
                } else {
                    $comprobarArmario = ArmarioFicha::where('ficha_id', $ficha->ficha_id)
                        ->where('user_id', auth()->user()->id)
                        ->first();
                    if ($comprobarArmario != null) {
                        $error = "Ya tienes comprada esta ficha.";
                    } else {
                        if (auth()->user()->Online == 1) {
                            $error = "Desconectate del juego para realizar esta accion.";
                        } else {
                            Usuario::where('id', auth()->user()->id)
                                ->update(['oro' => auth()->user()->oro - $ficha->oro]);

                            $newFicha = new ArmarioFicha();
                            $newFicha->user_id = auth()->user()->id;
                            $newFicha->ficha_id = $ficha->ficha_id;
                            $newFicha->save();
                        }
                    }
                }
            }
        } else {
            $error = "Se ha producido un error en la compra.";
        }
        return response()->json([
            'error' => $error,
            'content' => "Compra realizada.",
        ], Response::HTTP_CREATED);
    }
}
