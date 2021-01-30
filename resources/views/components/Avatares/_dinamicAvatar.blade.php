@php
if ($usuario->avatar == 3){
$pelo = substr($usuario->colores, 6, 6);
$bandana = substr($usuario->colores, 12, 6);
$piel = substr($usuario->colores, 0, 6);
$ojos = substr($usuario->colores, 36, 6);
$short = substr($usuario->colores, 24, 6);
$floresshort = substr($usuario->colores, 18, 6);
}
if ($usuario->avatar == 1){
$pelo = substr($usuario->colores, 6, 6);
$piel = substr($usuario->colores, 0, 6);
$camisa = substr($usuario->colores, 12, 6);
$cinturon = substr($usuario->colores, 18, 6);
$pantalon = substr($usuario->colores, 24, 6);
}
if ($usuario->avatar == 2){
$pelo = substr($usuario->colores, 6, 6);
$bandana = substr($usuario->colores, 18, 6);
$lentes = substr($usuario->colores, 30, 6);
$bestido = substr($usuario->colores, 12, 6);
$piel = substr($usuario->colores, 0, 6);
}
if ($usuario->avatar == 4){
$pelo = substr($usuario->colores, 6, 6);
$bandana = substr($usuario->colores, 12, 6);
$pantalon = substr($usuario->colores, 18, 6);
$camisa = substr($usuario->colores, 24, 6);
$piel = substr($usuario->colores, 0, 6);
}
if ($usuario->avatar == 5){
$poncho = substr($usuario->colores, 6, 6);
$gomas = substr($usuario->colores, 18, 6);
$piel = substr($usuario->colores, 0, 6);
$talisman1 = substr($usuario->colores, 24, 6);
$talisman2 = substr($usuario->colores, 30, 6);
}
if ($usuario->avatar == 6){
$lentes = substr($usuario->colores, 12, 6);
$short = substr($usuario->colores, 6, 6);
$camisa = substr($usuario->colores, 18, 6);
$piel = substr($usuario->colores, 0, 6);
}
if ($usuario->avatar == 7){
$gorro = substr($usuario->colores, 6, 6);
$blusa = substr($usuario->colores, 12, 6);
$pelo = substr($usuario->colores, 18, 6);
$piel = substr($usuario->colores, 0, 6);
$falda = substr($usuario->colores, 24, 6);
$lineasfalda = substr($usuario->colores, 30, 6);
}
if ($usuario->avatar == 8){
$pelo = substr($usuario->colores, 0, 6);
$camisa = substr($usuario->colores, 18, 6);
$kimono = substr($usuario->colores, 12, 6);
$campanita = substr($usuario->colores, 24, 6);
$piel = substr($usuario->colores, 6, 6);
}
if ($usuario->avatar == 9){
$pelo = substr($usuario->colores, 0, 6);
$piel = substr($usuario->colores, 6, 6);
$camisa = substr($usuario->colores, 12, 6);
$pantalon = substr($usuario->colores, 18, 6);
$bumeran1 = substr($usuario->colores, 24, 6);
$gafas = substr($usuario->colores, 30, 6);
$bumeran2 = substr($usuario->colores, 36, 6);
}
if ($usuario->avatar == 10){
$pantalon = substr($usuario->colores, 24, 6);
$ojos = substr($usuario->colores, 30, 6);
$pelo = substr($usuario->colores, 6, 6);
$piel = substr($usuario->colores, 0, 6);
$rayas = substr($usuario->colores, 18, 6);
$camisa = substr($usuario->colores, 12, 6);
}
if ($usuario->avatar == 11){
$piel = substr($usuario->colores, 0, 6);
$pelo = substr($usuario->colores, 6, 6);
$sombrero = substr($usuario->colores, 12, 6);
$correa = substr($usuario->colores, 18, 6);
$ojos = substr($usuario->colores, 24, 6);
}
@endphp
@if ($usuario->avatar == 1)
    <div class="mb-2">
        <div class="d-flex justify-content-center">
            <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
                <object data="{{ url('' . $route . 'nerd.svg') }}" type="image/svg+xml">
                    <param name="pelo" value="#{{ $pelo }}">
                    <param name="piel" value="#{{ $piel }}">
                    <param name="camisa" value="#{{ $camisa }}">
                    <param name="cinturon" value="#{{ $cinturon }}">
                    <param name="pantalon" value="#{{ $pantalon }}">
                </object>
            </div>
        </div>
    </div>
@elseif ($usuario->avatar == 2)
    <div class="mb-2">
        <div class="d-flex justify-content-center">
            <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
                <object data="{{ url('' . $route . 'vieja.svg') }}" type="image/svg+xml">
                    <param name="pelo" value="#{{ $pelo }}">
                    <param name="bandana" value="#{{ $bandana }}">
                    <param name="lentes" value="#{{ $lentes }}">
                    <param name="bestido" value="#{{ $bestido }}">
                    <param name="piel" value="#{{ $piel }}">
                </object>
            </div>
        </div>
    </div>
@elseif ($usuario->avatar == 3)
    <div class="d-flex justify-content-center">
        <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%;">
            <object data="{{ url('' . $route . 'rasta.svg') }}" type="image/svg+xml">
                <param name="pelo" value="#{{ $pelo }}" />
                <param name="bandana" value="#{{ $bandana }}" />
                <param name="ojos" value="#{{ $ojos }}" />
                <param name="piel" value="#{{ $piel }}" />
                <param name="short" value="#{{ $short }}" />
                <param name="floresshort" value="#{{ $floresshort }}" />
            </object>
        </div>
    </div>
@elseif ($usuario->avatar == 4)
    <div class="mb-2">
        <div class="d-flex justify-content-center">
            <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
                <object data="{{ url('' . $route . 'viejo.svg') }}" type="image/svg+xml">
                    <param name="pelo" value="#{{ $pelo }}">
                    <param name="bandana" value="#{{ $bandana }}">
                    <param name="pantalon" value="#{{ $pantalon }}">
                    <param name="camisa" value="#{{ $camisa }}">
                    <param name="piel" value="#{{ $piel }}">
                </object>
            </div>
        </div>
    </div>
@elseif ($usuario->avatar == 5)
    <div class="mb-2">
        <div class="d-flex justify-content-center">
            <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
                <object data="{{ url('' . $route . 'india.svg') }}" type="image/svg+xml">
                    <param name="poncho" value="#{{ $poncho }}">
                    <param name="gomas" value="#{{ $gomas }}">
                    <param name="piel" value="#{{ $piel }}">
                    <param name="talisman1" value="#{{ $talisman1 }}">
                    <param name="talisman2" value="#{{ $talisman2 }}">
                </object>
            </div>
        </div>
    </div>
@elseif ($usuario->avatar == 6)
    <div class="mb-2">
        <div class="d-flex justify-content-center">
            <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
                <object data="{{ url('' . $route . 'mafioso.svg') }}" type="image/svg+xml">
                    <param name="lentes" value="#{{ $lentes }}">
                    <param name="short" value="#{{ $short }}">
                    <param name="camisa" value="#{{ $camisa }}">
                    <param name="piel" value="#{{ $piel }}">
                </object>
            </div>
        </div>
    </div>
@elseif ($usuario->avatar == 7)
    <div class="mb-2">
        <div class="d-flex justify-content-center">
            <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
                <object data="{{ url('' . $route . 'zeta.svg') }}" type="image/svg+xml">
                    <param name="gorro" value="#{{ $gorro }}">
                    <param name="blusa" value="#{{ $blusa }}">
                    <param name="pelo" value="#{{ $pelo }}">
                    <param name="piel" value="#{{ $piel }}">
                    <param name="falda" value="#{{ $falda }}">
                    <param name="lineasfalda" value="#{{ $lineasfalda }}">
                </object>
            </div>
        </div>
    </div>
@elseif ($usuario->avatar == 8)
    <div class="mb-2">
        <div class="d-flex justify-content-center">
            <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
                <object data="{{ url('' . $route . 'gata.svg') }}" type="image/svg+xml">
                    <param name="pelo" value="#{{ $pelo }}">
                    <param name="camisa" value="#{{ $camisa }}">
                    <param name="kimono" value="#{{ $kimono }}">
                    <param name="campanita" value="#{{ $campanita }}">
                    <param name="piel" value="#{{ $piel }}">
                </object>
            </div>
        </div>
    </div>
@elseif ($usuario->avatar == 9)
    <div class="mb-2">
        <div class="d-flex justify-content-center">
            <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
                <object data="{{ url('' . $route . 'boomer.svg') }}" type="image/svg+xml">
                    <param name="pelo" value="#{{ $pelo }}">
                    <param name="piel" value="#{{ $piel }}">
                    <param name="camisa" value="#{{ $camisa }}">
                    <param name="pantalon" value="#{{ $pantalon }}">
                    <param name="bumeran1" value="#{{ $bumeran1 }}">
                    <param name="gafas" value="#{{ $gafas }}">
                    <param name="bumeran2" value="#{{ $bumeran2 }}">
                </object>
            </div>
        </div>
    </div>
@elseif ($usuario->avatar == 10)
    <div class="mb-2">
        <div class="d-flex justify-content-center">
            <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
                <object data="{{ url('' . $route . 'DJ.svg') }}" type="image/svg+xml">
                    <param name="pantalon" value="#{{ $pantalon }}">
                    <param name="ojos" value="#{{ $ojos }}">
                    <param name="pelo" value="#{{ $pelo }}">
                    <param name="piel" value="#{{ $piel }}">
                    <param name="rayas" value="#{{ $rayas }}">
                    <param name="camisa" value="#{{ $camisa }}">
                </object>
            </div>
        </div>
    </div>
@elseif ($usuario->avatar == 11)
    <div class="mb-2">
        <div class="d-flex justify-content-center">
            <div class="mt-1" style="width: {{ $width }}; height: {{ $height }}; overflow:hidden; border-radius: 50%">
                <object data="{{ url('' . $route . 'bruja.svg') }}" type="image/svg+xml">
                    <param name="piel" value="#{{ $piel }}"> 
                    <param name="pelo" value="#{{ $pelo }}"> 
                    <param name="sombrero" value="#{{ $sombrero }}"> 
                    <param name="correa" value="#{{ $correa }}"> 
                    <param name="ojos" value="#{{ $ojos }}"> 
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
