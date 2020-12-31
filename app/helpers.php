<?php

use App\Models\ChatMessage;
use App\Models\Usuario;
use App\Models\WebSupportMessage;

function user_last_activity_fetch($amigoId)
{
  $pads = App\Models\LoginDetail::where('user_id', $amigoId)
    ->orderBy('last_activity', 'DESC')
    ->limit(1)
    ->get();
  foreach ($pads as $pad) {
    return $pad->last_activity;
  }
}
function fetch_user_chat_history($from_user_id, $to_user_id)
{
  $mensajes = ChatMessage::where(function ($query) use ($from_user_id, $to_user_id) {
    $query->where('from_user_id', '=', $from_user_id)
      ->where('to_user_id', '=', $to_user_id);
  })
    ->orWhere(function ($query) use ($from_user_id, $to_user_id) {
      $query->where('from_user_id', '=', $to_user_id)
        ->where('to_user_id', '=', $from_user_id);
    })
    ->orderBy('timestamp', 'DESC')
    ->get();

  $output = '<ul class="list-unstyled">';
  foreach ($mensajes as $mensaje) {
    $user_name = '';
    if ($mensaje->from_user_id == $from_user_id) {
      $user_name = '<b class="text-success"><strong>Yo</strong></b>';
    } else {

      $user_name = '<b style="color: #3490dc;"><strong>' . get_user_name($mensaje->from_user_id) . '</strong></b>';
    }
    $output = $output . '
      <li style="border-bottom:1px dotted #ccc">
      <p>' . $user_name . ' - ' . $mensaje->chat_message . '
        <div align="right">
        <small><em>' . $mensaje->timestamp . '</em></small>
        </div>
      </p>
      </li>
    ';
  }
  $output =  $output . '</ul>';

  ///Borar mensajes pendientes
  ChatMessage::where('from_user_id', $to_user_id)
    ->where('to_user_id', $from_user_id)
    ->where('status', 1)
    ->update(['status' => 0]);

  return $output;
}


function get_user_name($user_id)
{
  $usuario = Usuario::where('id', $user_id)
    ->first();

  return $usuario->nombre;
}

function Gcrypt($password)
{
  $key = 54642;
  $hash = "";
  $porciones = str_split($password);
  foreach ($porciones as $c) {
    $hash = $hash . ord($c);
  }
  $hash  = $hash . $key;
  $charSet = str_split($hash);
  sort($charSet);
  $h2 = "";
  foreach ($charSet as $c2) {
    $h2 = $h2 . $c2;
  }
  $gcrypt = "";
  $g2 = str_split($h2);
  foreach ($g2 as $c) {
    $gcrypt = $gcrypt . ord($c);
  }
  $gcrypt = str_split($gcrypt);
  sort($gcrypt);
  $newPassword = "";
  foreach ($gcrypt as $c) {
    $newPassword = $newPassword . $c;
  }
  return $newPassword;
}

function count_unseen_message($from_user_id, $to_user_id)
{
  $messages = ChatMessage::where('from_user_id', $from_user_id)
    ->where('to_user_id', $to_user_id)
    ->where('status', 1)
    ->count();

  if ($messages > 0) {
    return $messages;
  }
}

function supportMessages()
{
  $mensajes = WebSupportMessage::where('id_usuario', auth()->user()->id)
    ->where('visto', 1)->count();
  if ($mensajes > 0) {
    return $mensajes;
  }
}
function obtenerAmigosRecomendados()
{
  if (!session()->has('amigosRecomendados')) {
    $amigosRecomendados = Usuario::inRandomOrder()
    ->limit(7)
    ->get();

    session(['amigosRecomendados' => $amigosRecomendados]);
  }
}
function eliminarAmigosRecomendados(){
  session()->pull('amigosRecomendados');
}
