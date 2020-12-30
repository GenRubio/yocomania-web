@php 
  if ($usuario->avatar >= 1 && $usuario->avatar <= 5){
      $pelo =  substr($usuario->colores, 6, 6);
      $cinta = substr($usuario->colores, 12, 6);
      $ojos = substr($usuario->colores, 36, 6);
      $cuerpo = substr($usuario->colores, 0, 6);
  }
@endphp
@if ($usuario->avatar == 1)
<div class="mb-2">
    <div class="d-flex justify-content-center">
        <div class="mt-1"
            style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
            <object data="{{ url('' . $route . 'nerd.svg') }}" type="image/svg+xml">
            </object>
        </div>
    </div>
</div>
@elseif ($usuario->avatar == 2)
<div class="mb-2">
    <div class="d-flex justify-content-center">
        <div class="mt-1"
            style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
            <object data="{{ url('' . $route . 'vieja.svg') }}" type="image/svg+xml">
            </object>
        </div>
    </div>
</div>
@elseif ($usuario->avatar == 3)
<div class="d-flex justify-content-center">
    <div class="mt-1"
        style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%;">
        <object data="{{ url('' . $route . 'rasta.svg') }}" type="image/svg+xml">
            <param name="pelo" value="#{{ $pelo }}" />
            <param name="cinta" value="#{{ $cinta }}" />
            <param name="ojos" value="#{{ $ojos }}" />
            <param name="cuerpo" value="#{{ $cuerpo }}" />
        </object>
    </div>
</div>
@elseif ($usuario->avatar == 4)
<div class="mb-2">
    <div class="d-flex justify-content-center">
        <div class="mt-1"
            style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
            <object data="{{ url('' . $route . 'viejo.svg') }}" type="image/svg+xml">
            </object>
        </div>
    </div>
</div>
@elseif ($usuario->avatar == 5)
<div class="mb-2">
    <div class="d-flex justify-content-center">
        <div class="mt-1"
            style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
            <object data="{{ url('' . $route . 'india.svg') }}" type="image/svg+xml">
            </object>
        </div>
    </div>
</div>
@elseif ($usuario->avatar == 6)
<div class="mb-2">
    <div class="d-flex justify-content-center">
        <div class="mt-1"
            style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
            <object data="{{ url('' . $route . 'mafioso.svg') }}"
                type="image/svg+xml">
            </object>
        </div>
    </div>
</div>
@elseif ($usuario->avatar == 7)
<div class="mb-2">
    <div class="d-flex justify-content-center">
        <div class="mt-1"
            style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
            <object data="{{ url('' . $route . 'zeta.svg') }}" type="image/svg+xml">
            </object>
        </div>
    </div>
</div>
@elseif ($usuario->avatar == 8)
<div class="mb-2">
    <div class="d-flex justify-content-center">
        <div class="mt-1"
            style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
            <object data="{{ url('' . $route . 'gata.svg') }}" type="image/svg+xml">
            </object>
        </div>
    </div>
</div>
@elseif ($usuario->avatar == 9)
<div class="mb-2">
    <div class="d-flex justify-content-center">
        <div class="mt-1"
            style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
            <object data="{{ url('' . $route . 'boomer.svg') }}" type="image/svg+xml">
            </object>
        </div>
    </div>
</div>
@elseif ($usuario->avatar == 10)
<div class="mb-2">
    <div class="d-flex justify-content-center">
        <div class="mt-1"
            style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
            <object data="{{ url('' . $route . 'DJ.svg') }}" type="image/svg+xml">
            </object>
        </div>
    </div>
</div>
@elseif ($usuario->avatar == 11)
<div class="mb-2">
    <div class="d-flex justify-content-center">
        <div class="mt-1"
            style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
            <object data="{{ url('' . $route . 'bruja.svg') }}" type="image/svg+xml">
            </object>
        </div>
    </div>
</div>
@endif

<!-- CC9966 FFBF20 FF6600 FFFFFF FFFFFF FFFFFF DEFAFF
Rasta 3
param(cuerpo)
param(pelo)
param(cinta)
param(ojos)

Nerd 1
param(cuerpo)
param(camiseta)
param(cinta)
param(pantalon)
param(pelo)

Vieja 2
param(camiseta)
param(cuerpo)
param(chaleco)
param(pelo)
param(ojos)
param(cinta)

Viejo 4
param(cuerpo)
param(pelo)
param(camiseta)
param(cinta)
param(ojos)
param(barba)

India 5
param(pelo)
param(camiseta)
param(cuerpo)
param(decora)
param(decoraMano)


Mafioso 6
param(camiseta)
param(cuerpo)
param(ojos)

Zeta 7
param(cuerpo)
param(camiseta)
param(pelo)
param(cinta)


Gata 8
param(camiseta)
param(pelo)
param(cuerpo)
param(decora)

Boomer 9
param(gafas)
param(bumerang)
param(camiseta)
param(cuerpo)
param(pelo)
-->