@if ($usuario->puntos_cocos >= 10 && $usuario->puntos_cocos <= 19)
<img src="{{ url('/images/estadisticas/coco_1.png') }}">
@elseif($usuario->puntos_cocos >= 20 && $usuario->puntos_cocos <= 49)
<img src="{{ url('/images/estadisticas/coco_2.png') }}">
@elseif($usuario->puntos_cocos >= 50 && $usuario->puntos_cocos <= 99)
<img src="{{ url('/images/estadisticas/coco_3.png') }}">
@elseif($usuario->puntos_cocos >= 100 && $usuario->puntos_cocos <= 149)
<img src="{{ url('/images/estadisticas/coco_4.png') }}">
@elseif($usuario->puntos_cocos >= 150 && $usuario->puntos_cocos <= 199)
<img src="{{ url('/images/estadisticas/coco_5.png') }}">
@elseif($usuario->puntos_cocos >= 200 && $usuario->puntos_cocos <= 299)
<img src="{{ url('/images/estadisticas/coco_6.png') }}">
@elseif($usuario->puntos_cocos >= 300 && $usuario->puntos_cocos <= 399)
<img src="{{ url('/images/estadisticas/coco_7.png') }}">
@elseif($usuario->puntos_cocos >= 400 && $usuario->puntos_cocos <= 599)
<img src="{{ url('/images/estadisticas/coco_8.png') }}">
@elseif($usuario->puntos_cocos >= 600)
<img src="{{ url('/images/estadisticas/coco_9.png') }}">
@else 
<img src="{{ url('/images/estadisticas/coco_0.png') }}">
@endif