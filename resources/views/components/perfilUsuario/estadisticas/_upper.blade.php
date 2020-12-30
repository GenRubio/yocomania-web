@if ($usuario->uppers_enviados >= 24 && $usuario->uppers_enviados <= 49)
<img src="{{ url('/images/estadisticas/upper_1.png') }}">
@elseif($usuario->uppers_enviados >= 50 && $usuario->uppers_enviados <= 99)
<img src="{{ url('/images/estadisticas/upper_2.png') }}">
@elseif($usuario->uppers_enviados >= 100 && $usuario->uppers_enviados <= 199)
<img src="{{ url('/images/estadisticas/upper_3.png') }}">
@elseif($usuario->uppers_enviados >= 200 && $usuario->uppers_enviados <= 499)
<img src="{{ url('/images/estadisticas/upper_4.png') }}">
@elseif($usuario->uppers_enviados >= 500 && $usuario->uppers_enviados <= 1499)
<img src="{{ url('/images/estadisticas/upper_5.png') }}">
@elseif($usuario->uppers_enviados >= 1500 && $usuario->uppers_enviados <= 2999)
<img src="{{ url('/images/estadisticas/upper_6.png') }}">
@elseif($usuario->uppers_enviados >= 3000 && $usuario->uppers_enviados <= 5999)
<img src="{{ url('/images/estadisticas/upper_7.png') }}">
@elseif($usuario->uppers_enviados >= 6000 && $usuario->uppers_enviados <= 8999)
<img src="{{ url('/images/estadisticas/upper_8.png') }}">
@elseif($usuario->uppers_enviados >= 9000)
<img src="{{ url('/images/estadisticas/upper_9.png') }}">
@else 
<img src="{{ url('/images/estadisticas/upper_0.png') }}">
@endif