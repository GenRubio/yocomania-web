@component('mail::message')
# 

Hola {{ $nombre }} , has solicitado el cambio de contraseña.
<br>
Haz clic en el botón para cambiar tu contraseña.
@component('mail::button', ['url' => $url])
Cambiar contraseña
@endcomponent

Att: Yocomania Teams
@endcomponent