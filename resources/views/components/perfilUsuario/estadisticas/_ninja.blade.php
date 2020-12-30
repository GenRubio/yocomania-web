@if ($usuario->puntos_ninja >= 400 && $usuario->puntos_ninja <= 409)
<img src="{{ url('/images/estadisticas/ninja_0.png') }}">
@elseif($usuario->puntos_ninja >= 410 && $usuario->puntos_ninja <= 419)
<img src="{{ url('/images/estadisticas/ninja_1.png') }}">
@elseif($usuario->puntos_ninja >= 420 && $usuario->puntos_ninja <= 449)
<img src="{{ url('/images/estadisticas/ninja_2.png') }}">
@elseif($usuario->puntos_ninja >= 450 && $usuario->puntos_ninja <= 499)
<img src="{{ url('/images/estadisticas/ninja_3.png') }}">
@elseif($usuario->puntos_ninja >= 500 && $usuario->puntos_ninja <= 549)
<img src="{{ url('/images/estadisticas/ninja_4.png') }}">
@elseif($usuario->puntos_ninja >= 550 && $usuario->puntos_ninja <= 599)
<img src="{{ url('/images/estadisticas/ninja_5.png') }}">
@elseif($usuario->puntos_ninja >= 600 && $usuario->puntos_ninja <= 699)
<img src="{{ url('/images/estadisticas/ninja_6.png') }}">
@elseif($usuario->puntos_ninja >= 700 && $usuario->puntos_ninja <= 799)
<img src="{{ url('/images/estadisticas/ninja_7.png') }}">
@elseif($usuario->puntos_ninja >= 800 && $usuario->puntos_ninja <= 999)
<img src="{{ url('/images/estadisticas/ninja_8.png') }}">
@elseif($usuario->puntos_ninja >= 1000)
<img src="{{ url('/images/estadisticas/ninja_9.png') }}">
@else 
<img src="{{ url('/images/estadisticas/ninja_0.png') }}">
@endif