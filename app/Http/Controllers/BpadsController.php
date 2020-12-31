<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\BpadAmigo;
use App\Models\ChatMessage;
use App\Models\LoginDetail;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class BpadsController extends Controller
{
    public function index()
    {
        //BpadAmigo::where('ID_1', auth()->user()->id)->get();
        $bpads = DB::table('bpad_amigos')
        ->leftJoin('login_details', 'bpad_amigos.ID_2', '=', 'login_details.user_id')
        ->where('ID_1', '=', auth()->user()->id)
        ->where('Solicitud', '=', 0)
        ->orderBy('login_details.last_activity', 'DESC')
        ->get();
        


        $amigos = array();
        if (is_null($bpads)) {
            $amigos = null;
        } else {
            foreach ($bpads as $bpad) {
              $amigo = Usuario::where('id', $bpad->ID_2)->first();
               array_push($amigos, $amigo);
            }
        }

        $content = view('components.perfilUsuario._bPadsLoad', compact('amigos', 'bpads'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }
    public function activity()
    {
        LoginDetail::where('user_id', auth()->user()->id)
            ->update(['last_activity' => now()]);
    }
    public function send(Request $request)
    {
        $message = new ChatMessage();
        $message->to_user_id = $request->get('to_user_id');
        $message->from_user_id = auth()->user()->id;
        $message->chat_message = $request->get('chat_message');
        $message->save();

        return response()->json([
            'content' => fetch_user_chat_history(auth()->user()->id, $request->get('to_user_id')),
        ], Response::HTTP_CREATED);
    }
    public function fetchChat(Request $request)
    {
        return response()->json([
            'content' => fetch_user_chat_history(auth()->user()->id, $request->get('to_user_id')),
        ], Response::HTTP_CREATED);
    }
    public function avatarPad(Request $request)
    {
        $usuario = Usuario::where('id', $request->get('to_user_id'))->first();
        $height = '50px';
        $width = '50px';
        $route = '/images/avataresSVG/chatPad/';

        return response()->json([
            'content' => view('components.Avatares._dinamicAvatar', compact('usuario', 'height', 'width', 'route'))->render(),
        ], Response::HTTP_CREATED);
    }

    public function buscarYocomaniaco(Request $request){
        $bpads = DB::table('bpad_amigos')
        ->join('usuarios', 'bpad_amigos.ID_1', '=', auth()->user()->id)
        ->where('bpad_amigos.ID_2', '=', 'usuarios.id')
        ->where('usuarios.nombre', 'like', ('%'. $request->get('query'). '%'))
        ->get();
        
        $amigos = array();
        if (is_null($bpads)) {
            $amigos = null;
        } else {
            foreach ($bpads as $bpad) {
              $amigo = Usuario::where('id', $bpad->ID_1)->first();
               array_push($amigos, $amigo);
            }
        }

        $content = view('components.perfilUsuario._bPadsLoad', compact('amigos', 'bpads'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }

    ///Agregar - Cancelar Solicitud - Eliminar Amigo
    public function amigosManager(Request $request){
        if (!empty($request->get("accion"))){
            $usuario = Usuario::where('id', '=', $request->get("amigoId"))->first();
            $accion = $request->get("accion");

            if ($accion == "eliminar"){
                BpadAmigo::where('ID_1', auth()->user()->id)
                ->where('ID_2', $usuario->id)
                ->where('Solicitud', 0)
                ->delete();

                BpadAmigo::where('ID_2', auth()->user()->id)
                ->where('ID_1', $usuario->id)
                ->where('Solicitud', 0)
                ->delete();
            }
            else if ($accion == "cancelar"){
                BpadAmigo::where('ID_2', auth()->user()->id)
                ->where('ID_1', $usuario->id)
                ->where('Solicitud', 1)
                ->delete();
            }
            else if ($accion == "agregar"){
                $agregar = new BpadAmigo();
                $agregar->ID_2 = auth()->user()->id;
                $agregar->ID_1 = $usuario->id;
                $agregar->save();
            }
        }
        else{
            $usuario = Usuario::where('id', '=', $request->get("usuario"))->first();
        }
        $content = view('components.perfilUsuario._perfil-acciones', compact('usuario'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }

    public function recomendado(Request $request){

        $amigosRecomendados = session()->get('amigosRecomendados');

        $content = view('components.perfilUsuario.buscarAmigos.amigos-interfaz', compact('amigosRecomendados'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }

    public function buscarAmigo(Request $request){
        $usuarios = Usuario::where('nombre', 'like', ('%'. $request->get('query'). '%'))
        ->limit(7)
        ->get();

        $content = view('components.perfilUsuario.buscarAmigos.amigos-search-live', compact('usuarios'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }

    public function buscarTodosAmigos(Request $request){
        $usuarios = Usuario::where('nombre', 'like', ('%'. $request->get('search-live-person'). '%'))
        ->paginate(7);

        $content = view('components.perfilUsuario.buscarAmigos.amigos-search-todos', compact('usuarios'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }

    public function paginate_search(Request $request){
        $usuarios = Usuario::where('nombre', 'like', ('%'. $request->get('search_live_person'). '%'))
        ->paginate(7);

        $content = view('components.perfilUsuario.buscarAmigos.amigos-search-todos', compact('usuarios'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }

    public function obtenerSolicitudes(){
        $personas = BpadAmigo::where('ID_1', auth()->user()->id)
        ->where('Solicitud', 1)
        ->get();

        $solicitudes = array();
        if (is_null($personas)) {
            $solicitudes = null;
        } else {
            foreach ($personas as $bpad) {
               $user = Usuario::where('id', $bpad->ID_2)->first();
               array_push($solicitudes, $user);
            }
        }

        $content = view('components.perfilUsuario.solicitudes-Amistad', compact('solicitudes'))->render();
        return response()->json([
            'content' => $content,
        ], Response::HTTP_CREATED);
    }

    public function aceptarSolicitud(Request $request){
       
        BpadAmigo::where('ID_1', auth()->user()->id)
        ->where('ID_2', $request->get('usaurioId'))
        ->update(['Solicitud' => '0']);

        $amigo = new BpadAmigo();
        $amigo->ID_1 = $request->get('usaurioId');
        $amigo->ID_2 = auth()->user()->id;
        $amigo->Solicitud = 0;
        $amigo->save();

        return response()->json([
        ], Response::HTTP_CREATED);
    }
    public function denegarSolicitud(Request $request){
        BpadAmigo::where('ID_1', auth()->user()->id)
        ->where('ID_2', $request->get('usaurioId'))
        ->where('Solicitud', 1)
        ->delete();

        return response()->json([
        ], Response::HTTP_CREATED);
    }
}
