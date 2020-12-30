@if ($usuario->puntos_ninja >= 400 && $usuario->puntos_ninja <= 409)
<img src="{{ url('/images/levelsSvg/500.svg') }}" height="46" , width="46">
@elseif($usuario->puntos_ninja >= 410 && $usuario->puntos_ninja <= 419)
<img src="{{ url('/images/levelsSvg/501.svg') }}" height="43" , width="43">
@elseif($usuario->puntos_ninja >= 420 && $usuario->puntos_ninja <= 449)
<img src="{{ url('/images/levelsSvg/502.svg') }}" height="43" , width="43">
@elseif($usuario->puntos_ninja >= 450 && $usuario->puntos_ninja <= 499)
<img src="{{ url('/images/levelsSvg/503.svg') }}" height="43" , width="43">
@elseif($usuario->puntos_ninja >= 500 && $usuario->puntos_ninja <= 549)
<img src="{{ url('/images/levelsSvg/504.svg') }}" height="43" , width="43">
@elseif($usuario->puntos_ninja >= 550 && $usuario->puntos_ninja <= 599)
<img src="{{ url('/images/levelsSvg/505.svg') }}" height="43" , width="43">
@elseif($usuario->puntos_ninja >= 600 && $usuario->puntos_ninja <= 699)
<img src="{{ url('/images/levelsSvg/506.svg') }}" height="43" , width="43">
@elseif($usuario->puntos_ninja >= 700 && $usuario->puntos_ninja <= 799)
<img src="{{ url('/images/levelsSvg/407.svg') }}" height="43" , width="43">
@elseif($usuario->puntos_ninja >= 800 && $usuario->puntos_ninja <= 999)
<img src="{{ url('/images/levelsSvg/508.svg') }}" height="43" , width="43">
@elseif($usuario->puntos_ninja >= 1000)
<img src="{{ url('/images/levelsSvg/509.svg') }}" height="43" , width="43">
@else 
<img src="{{ url('/images/levelsSvg/500.svg') }}" height="46" , width="46">
@endif