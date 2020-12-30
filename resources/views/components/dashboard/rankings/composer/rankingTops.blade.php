@foreach ($usuarios as $key => $usuario)
    @if ($key + 1 == 1)
        <div class="row border p-2" style="background-color: #ffff00;font-size: 17px;">
            <div class="col">
                <strong>{{ $key + 1 }}</strong>
            </div>
            <div class="col">
                <strong>{{ $usuario->nombre }}</strong>
            </div>
            <div class="col">
                <strong>{{ $usuario->puntos }}</strong>
            </div>
            <div class="col">
                @isset($upper_semanal)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>5000</strong>
                        </div>
                    </div>
                @endisset
                @isset($silver_ring)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>8000</strong>
                        </div>
                    </div>
                @endisset
                @isset($silver_cocos)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>8000</strong>
                        </div>
                    </div>
                @endisset
                @isset($golden_ring)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/ranking/upperOro.png') }}" height="35" , width="28">
                        </div>
                        <div class="ml-2">
                            <strong>Trofeo Oro</strong>
                        </div>
                    </div>
                @endisset
                @isset($sendero_oculto)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/ranking/lianaOro.png') }}" height="35" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>Trofeo Oro</strong>
                        </div>
                    </div>
                @endisset
                @isset($golden_cocos)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/ranking/cocoOro.png') }}" height="35" , width="26">
                        </div>
                        <div class="ml-2">
                            <strong>Trofeo Oro</strong>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    @elseif ($key + 1 == 2)
        <div class="row border p-2" style="background-color: #ff9900;font-size: 17px;">
            <div class="col">
                <strong>{{ $key + 1 }}</strong>
            </div>
            <div class="col">
                <strong>{{ $usuario->nombre }}</strong>
            </div>
            <div class="col">
                <strong>{{ $usuario->puntos }}</strong>
            </div>
            <div class="col">
                @isset($upper_semanal)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>4000</strong>
                        </div>
                    </div>
                @endisset
                @isset($silver_cocos)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>6500</strong>
                        </div>
                    </div>
                @endisset
                @isset($silver_ring)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>6500</strong>
                        </div>
                    </div>
                @endisset
                @isset($golden_ring)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/ranking/upperPlata.png') }}" height="35" , width="28">
                        </div>
                        <div class="ml-2">
                            <strong>Trofeo Plata</strong>
                        </div>
                    </div>
                @endisset
                @isset($sendero_oculto)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/ranking/lianaPlata.png') }}" height="35" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>Trofeo Plata</strong>
                        </div>
                    </div>
                @endisset
                @isset($golden_cocos)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/ranking/cocoPlata.png') }}" height="35" , width="26">
                        </div>
                        <div class="ml-2">
                            <strong>Trofeo Plata</strong>
                        </div>
                    </div>
                @endisset

            </div>
        </div>
    @elseif ($key + 1 == 3)
        <div class="row border p-2" style="background-color: #f60;font-size: 17px;">
            <div class="col">
                <strong>{{ $key + 1 }}</strong>
            </div>
            <div class="col">
                <strong>{{ $usuario->nombre }}</strong>
            </div>
            <div class="col">
                <strong>{{ $usuario->puntos }}</strong>
            </div>
            <div class="col">
                @isset($upper_semanal)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>3000</strong>
                        </div>
                    </div>
                @endisset
                @isset($silver_cocos)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>4500</strong>
                        </div>
                    </div>
                @endisset
                @isset($silver_ring)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>4500</strong>
                        </div>
                    </div>
                @endisset
                @isset($golden_ring)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/ranking/upperBronce.png') }}" height="35" , width="28">
                        </div>
                        <div class="ml-2">
                            <strong>Trofeo Bronce</strong>
                        </div>
                    </div>
                @endisset

                @isset($sendero_oculto)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/ranking/lianaBronce.png') }}" height="35" , width="30">
                        </div>
                        <div class="ml-2">
                            <strong>Trofeo Bronce</strong>
                        </div>
                    </div>
                @endisset
                @isset($golden_cocos)
                    <div class="d-flex">
                        <div>
                            <img src="{{ url('/images/ranking/cocoBronce.png') }}" height="35" , width="26">
                        </div>
                        <div class="ml-2">
                            <strong>Trofeo Bronce</strong>
                        </div>
                    </div>
                @endisset

            </div>
        </div>
    @endif
@endforeach
