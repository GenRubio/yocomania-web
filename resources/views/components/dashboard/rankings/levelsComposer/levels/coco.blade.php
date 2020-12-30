@if ($usuario->puntos_cocos >= 10 && $usuario->puntos_cocos <= 19)
<img src="{{ url('/images/levelsSvg/9.svg') }}" height="40" , width="40">
@elseif($usuario->puntos_cocos >= 20 && $usuario->puntos_cocos <= 49)
<img src="{{ url('/images/levelsSvg/6.svg') }}" height="40" , width="40">
@elseif($usuario->puntos_cocos >= 50 && $usuario->puntos_cocos <= 99)
<img src="{{ url('/images/levelsSvg/12.svg') }}" height="40" , width="40">
@elseif($usuario->puntos_cocos >= 100 && $usuario->puntos_cocos <= 149)
<img src="{{ url('/images/levelsSvg/30.svg') }}" height="40" , width="40">
@elseif($usuario->puntos_cocos >= 150 && $usuario->puntos_cocos <= 199)
<img src="{{ url('/images/levelsSvg/24.svg') }}" height="40" , width="40">
@elseif($usuario->puntos_cocos >= 200 && $usuario->puntos_cocos <= 299)
<img src="{{ url('/images/levelsSvg/15.svg') }}" height="40" , width="40">
@elseif($usuario->puntos_cocos >= 300 && $usuario->puntos_cocos <= 399)
<img src="{{ url('/images/levelsSvg/18.svg') }}" height="40" , width="40">
@elseif($usuario->puntos_cocos >= 400 && $usuario->puntos_cocos <= 599)
<img src="{{ url('/images/levelsSvg/21.svg') }}" height="40" , width="40">
@elseif($usuario->puntos_cocos >= 600)
<img src="{{ url('/images/levelsSvg/2.svg') }}" height="40" , width="40">
@else 
<img src="{{ url('/images/levelsSvg/27.svg') }}" height="40" , width="40">
@endif