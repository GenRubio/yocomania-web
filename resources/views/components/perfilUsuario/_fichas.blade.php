<div class="p-1"></div>
<div class="row ml-1 mr-1 border p-2 rounded mb-1" style="background-color: aliceblue;">
    <div class="col text-center">
        <h4><strong style="color: #3490dc;">Armario de Fichas</strong></h4>
    </div>
</div>
@php
$fichas = App\Models\ArmarioFicha::where('user_id', $usuario->id)->get();
$fichasBloqueadas = App\Models\WebGameficha::get();

$misFichas = array();
$fichasNoMias = array();
foreach ($fichasBloqueadas as $fB) {
$tiene = false;
foreach ($fichas as $fM) {
if ($fB->ficha_id == $fM->ficha_id){
$tiene = true;
}
}
if ($tiene){
array_push($misFichas, $fB);
}
else{
array_push($fichasNoMias, $fB);
}
}


$fichaActual = "";
foreach ($fichasBloqueadas as $ficha) {
if ($usuario->edad == $ficha->ficha_id){
$fichaActual = $ficha->nombreImg;
break;
}
}
if ($fichaActual == ""){
$personajeMasculino = array(1, 3, 4, 6, 9, 10);
if (in_array($usuario->avatar, $personajeMasculino)){
$fichaActual = "fichaMuscle.png";
}
else{
$fichaActual = "fichaFamele.png";
}
}
@endphp
@if (empty($friend))
    <div class="row ml-1 mr-1 p-2 mb-1">
        <p>Bien venido a tu armario de fichas. Puedes comprar nuevas fichas en la tienda.<br>Para cambiar el color de la
            ficha dale click sobre ella.</p>
    </div>
@else
    <br>
@endif
<div id="miFicha" class="text-center">
    <img src="{{ url('/images/Fichas/' . $fichaActual) }}">
</div>
<hr>
<div class="row ml-1 mr-1">
    @if (empty($friend))
        @foreach ($misFichas as $ficha)
            <div class="col p-1 text-center">
                <img id="{{ $ficha->nombreImg }}" imagenOld="{{ $fichaActual }}" idFicha="{{ $ficha->ficha_id }}"
                    imagen="{{ $ficha->nombreImg }}" class="ficha" style="cursor: pointer;"
                    src="{{ url('/images/Fichas/' . $ficha->nombreImg) }}" height="200" , width="140">
            </div>
        @endforeach
        @foreach ($fichasNoMias as $ficha)
            <div class="col p-1 text-center">
                <img style="filter:brightness(0.4);" src="{{ url('/images/Fichas/' . $ficha->nombreImg) }}" height="200"
                    , width="140">
            </div>
        @endforeach
    @else
        @foreach ($misFichas as $ficha)
            <div class="col p-1 text-center">
                <img src="{{ url('/images/Fichas/' . $ficha->nombreImg) }}" height="200" , width="140">
            </div>
        @endforeach
        @foreach ($fichasNoMias as $ficha)
            <div class="col p-1 text-center">
                <img style="filter:brightness(0.4);" src="{{ url('/images/Fichas/' . $ficha->nombreImg) }}" height="200"
                    , width="140">
            </div>
        @endforeach
    @endif

</div>
<hr>
<br>
<br>
<br>
<script>
    $(document).ready(function() {
        $(document).on('click', '.ficha', function() {
            var idFicha = $(this).attr('idFicha');
            var imagen = $(this).attr('imagen');
            var urlImagen = `{{ url('/images/Fichas/` + imagen + `') }}`;
            $.ajax({
                url: "{{ route('change.ficha') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    idFicha: idFicha
                },
                success: function(data) {
                    $("#miFicha").html(`<img src="` + urlImagen + `">`);
                },
            });
        });
    });

</script>
