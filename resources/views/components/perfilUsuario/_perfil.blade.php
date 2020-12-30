<div class="row">
    <div class="col border-right">
        @include('components.Avatares._dinamicAvatar', ['usuario' => $usuario, 'height' => '100px', 'width' =>
        '100px', 'route' => '/images/avataresSVG/'])
    </div>
    <div class="col-5 text-center border-right">
        <div class="mt-3">
            @if ($usuario->vip > 0)
                <div class="d-flex justify-content-center">
                    <div>
                        <h3><strong style="color: #ba0aba">{{ $usuario->nombre }}</strong>
                    </div>
                    <div>
                        <img src="{{ url('/images/perfil/mariposa.png') }}" alt="">
                    </div>
                </div>
            @else
                <h3><strong>{{ $usuario->nombre }}</strong></h3>
            @endif
            <h6>{{ $usuario->bocadillo }}</h6>
            @if (empty($friend))
                <div class="d-flex justify-content-center">
                    <div class="mr-1">
                        <img src="{{ url('/images/perfil/monedasOro.png') }}" alt="" height="25px" , width="25px">
                        <span><strong style="color: #fcbf4f;">{{ $usuario->oro }}</strong></span>
                    </div>
                    <div>
                        <img src="{{ url('/images/perfil/monedasPlata.png') }}" alt="" height="25px" , width="25px">
                        <span><strong style="color: #aeaeae;">{{ $usuario->plata }}</strong></span>
                    </div>
                </div>
                @if ($usuario->vip > 0)
                    <h6 style="color: #ba0aba;">Membresía: {{ $usuario->end_vip }}</h6>
                @endif
            @endif

        </div>

    </div>
    <div class="col align-self-center">
        <br>
        @if (empty($friend))
            <a href="{{ route('download.launcher') }}" class="btn btn btn-primary btn-lg shadow p-3 btn-block">
                <strong>Descargar Juego </strong>
            </a>
        @else
            <div id="amigoOpciones"></div>
        @endif
        <br>
    </div>
</div>
<script>
    $(document).ready(function() {
        obtenerAccionPerfil();

        function obtenerAccionPerfil() {
            $.ajax({
                url: "{{ route('obtener.accion.perfil') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    usuario: "{{ $usuario->id }}",
                },
                success: function(data) {
                    $('#amigoOpciones').html(data.content);
                }
            });
        }
    });
</script>
