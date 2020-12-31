@foreach ($contenidos as $contenido)
    <div class="card">
        <div class="card-header">
            <strong>FanArt: {{ $contenido->created_at }}</strong>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $contenido->descripcion }}</p>
            <img src="{{ url($contenido->link) }}" height="400" , width="700">
            <br> <br>
            <button class="btn btn-success aceptarFanart{{ $contenido->id }}"
                data-usuarioId="{{ $contenido->user_id }}" data-fanartId="{{ $contenido->id }}">
                Aceptar
            </button>
            <button class="btn btn-danger eliminarFanart{{ $contenido->id }}"
                data-usuarioId="{{ $contenido->user_id }}" data-fanartId="{{ $contenido->id }}">
                Eliminar
            </button>
        </div>
        <script>
            $(document).ready(function() {
                $('.eliminarFanart{{ $contenido->id }}').on('click', function() {
                    let usuarioId = $(this).attr('data-usuarioId');
                    let fanartId = $(this).attr('data-fanartId');

                    $.ajax({
                        url: "{{ route('eliminar.fanart.creator') }}",
                        method: 'GET',
                        data: {
                            usuarioId: usuarioId,
                            fanartId: fanartId,
                        },
                        success: function(data) {
                            cargarCreadorFanart();
                        }
                    })
                });
                $('.aceptarFanart{{ $contenido->id }}').on('click', function() {
                    let usuarioId = $(this).attr('data-usuarioId');
                    let fanartId = $(this).attr('data-fanartId');

                    $.ajax({
                        url: "{{ route('aceptar.fanart.creator') }}",
                        method: 'GET',
                        data: {
                            usuarioId: usuarioId,
                            fanartId: fanartId,
                        },
                        success: function(data) {
                            cargarCreadorFanart();
                        }
                    })
                });

                function cargarCreadorFanart() {
                    $.ajax({
                        url: "{{ route('solicitud.fanart') }}",
                        method: "GET",
                        success: function(data) {
                            $('#cargarCreadorFanart').html(data.content);
                        }
                    })
                }
            });

        </script>
    </div>
    <br>
@endforeach