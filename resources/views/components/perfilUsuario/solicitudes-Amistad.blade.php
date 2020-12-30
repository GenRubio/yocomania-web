<div class="container shadow-lg rounded p-3" style="background-color: white;">
    @if (count($solicitudes) == 0)
        <div class="d-flex justify-content-center">
            <h5><strong>No hay solicitudes pendientes</strong></h5>
        </div>
    @else
        @foreach ($solicitudes as $persona)
            <div class=" rounded shadow m-4">
                <div class="row">
                    <div class="col border-right mb-2">
                        @include('components.Avatares._dinamicAvatar', ['usuario' => $persona, 'height' => '100px',
                        'width' =>
                        '100px', 'route' => '/images/avataresSVG/'])
                    </div>
                    <div class="col-5 text-center border-right">
                        <div class="mt-3">
                            <a href="{{ route('look.user.profile', $persona->nombre) }}" style="text-decoration: none">
                                @if ($persona->vip > 0)
                                    <div class="d-flex justify-content-center">
                                        <div>
                                            <h3><strong style="color: #ba0aba">{{ $persona->nombre }}</strong>
                                        </div>
                                        <div>
                                            <img src="{{ url('/images/perfil/mariposa.png') }}" alt="">
                                        </div>
                                    </div>
                                @else
                                    <h3><strong>{{ $persona->nombre }}</strong></h3>
                                @endif
                            </a>

                            <h6>{{ $persona->bocadillo }}</h6>
                        </div>

                    </div>
                    <div class="col align-self-center text-center">
                        <div class="row">
                            <div class="col text-right">
                                <form id="aceptarSolicitud">
                                    @csrf
                                    <input type="hidden" name="usaurioId" value="{{ $persona->id }}">
                                    <button type="submit" class="btn btn-success btn-lg text-right">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9.854-2.854a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <div class="col text-left">
                                <form id="denegarSolicitud">
                                    @csrf
                                    <input type="hidden" name="usaurioId" value="{{ $persona->id }}">
                                    <button type="submit" class="btn btn-danger btn-lg text-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-person-dash-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5-.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
<div style="min-height: 500px"></div>
<script>
    $(document).ready(function() {
        $("#aceptarSolicitud").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('user.aceptar.solicitud') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    cargarSolicitudesAmistad();
                }
            })
        });
        $("#denegarSolicitud").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('user.denegar.solicitud') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    cargarSolicitudesAmistad();
                }
            })
        });

        function cargarSolicitudesAmistad() {
            $.ajax({
                url: "{{ route('user.cargar.solicitudes') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#cargar-solicitudes').html(data.content);
                }
            })
        }
    });

</script>
