@if ($usuario->uppers_enviados >= 24 && $usuario->uppers_enviados <= 49)
<img src="{{ url('/images/levelsSvg/154.svg') }}" height="46" , width="46">
@elseif($usuario->uppers_enviados >= 50 && $usuario->uppers_enviados <= 99)
<img src="{{ url('/images/levelsSvg/156.svg') }}" height="46" , width="46">
@elseif($usuario->uppers_enviados >= 100 && $usuario->uppers_enviados <= 199)
<img src="{{ url('/images/levelsSvg/158.svg') }}" height="46" , width="46">
@elseif($usuario->uppers_enviados >= 200 && $usuario->uppers_enviados <= 499)
<img src="{{ url('/images/levelsSvg/160.svg') }}" height="46" , width="46">
@elseif($usuario->uppers_enviados >= 500 && $usuario->uppers_enviados <= 1499)
<img src="{{ url('/images/levelsSvg/162.svg') }}" height="46" , width="46">
@elseif($usuario->uppers_enviados >= 1500 && $usuario->uppers_enviados <= 2999)
<img src="{{ url('/images/levelsSvg/164.svg') }}" height="46" , width="46">
@elseif($usuario->uppers_enviados >= 3000 && $usuario->uppers_enviados <= 5999)
<img src="{{ url('/images/levelsSvg/166.svg') }}" height="46" , width="46">
@elseif($usuario->uppers_enviados >= 6000 && $usuario->uppers_enviados <= 8999)
<img src="{{ url('/images/levelsSvg/168.svg') }}" height="46" , width="46">
@elseif($usuario->uppers_enviados >= 9000)
<img style="height:46px; width:46px;" src="{{ url('/images/levelsSvg/170.svg') }}">
@else 
<img src="{{ url('/images/levelsSvg/152.svg') }}" height="46" , width="46">
@endif