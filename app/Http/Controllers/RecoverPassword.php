<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecoverPasswordRequest;
use App\Http\Requests\RecoverPasswordValidateRequest;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Mail\RecoverPasswordMail;
use App\Models\WebEvento;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RecoverPassword extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('me');
        } else {
            $videos = WebEvento::orderBy('id', 'DESC')
                ->where('tipo', 1)
                ->paginate(4);

            $eventos = WebEvento::orderBy('fecha', 'ASC')
                ->where('tipo', 2)
                ->paginate(4);

            return view('recoverPassword', compact('videos', 'eventos'));
        }
    }

    public function reciveEmail(RecoverPasswordRequest $request)
    {
        $user = Usuario::where('nombre', $request->get('nombreRecover'))
            ->where('email', $request->get('emailRecover'))
            ->first();

        if ($user === null) {
            return response()->json([
                'content' => 'error',
            ], Response::HTTP_CREATED);
        }
        $user->token = md5(uniqid(mt_rand(), false));
        $user->active_token = 1;
        $user->save();

        $url = URL::current() . "?id=" . $user->id . "&token=" . $user->token;

        Mail::to(request('emailRecover'))
            ->send(new RecoverPasswordMail($url, $user->nombre));

        return response()->json([
            'content' => 'Codigo de recuperacion ha sido enviado. Revisa tu email.',
        ], Response::HTTP_CREATED);
    }

    public function cambiarPassword(Request $request)
    {
        $userId = $request->id;
        $token =  $request->token;

        if ($userId == null || $token == null) {
            return redirect()->route('home');
        } else {
            $usuario = Usuario::where('id', '=', $userId)
                ->where('token',  '=', $token)
                ->first();
            if ($usuario != null) {
                if ($usuario->active_token == 1) {
                    $videos = WebEvento::orderBy('id', 'DESC')
                        ->where('tipo', 1)
                        ->paginate(4);

                    $eventos = WebEvento::orderBy('fecha', 'ASC')
                        ->where('tipo', 2)
                        ->paginate(4);
                    return view('recoverPasswordAut', compact('userId', 'token', 'videos', 'eventos'));
                }
            }

            return redirect()->route('home');
        }
    }

    public function cambiarPasswordSave(RecoverPasswordValidateRequest $request)
    {
        $userId = $request->userId;
        $token = $request->token;
        $newPassword = $request->passwordRepiteRecover;

        $usuario = Usuario::where('id', '=', $userId)
            ->where('token', '=', $token)
            ->first();

        if ($usuario != null) {
            if ($usuario->active_token == 1) {
                $usuario->token = "";
                $usuario->active_token = 0;
                $usuario->password = Gcrypt($newPassword);
                $usuario->save();

                Auth::login($usuario);
        
                return response()->json([
                ], Response::HTTP_CREATED);    
            }
        }

        return redirect()->route('home');
    }
}
