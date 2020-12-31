@foreach ($contenidos as $contenido)
    <div class="card">
        <div class="card-header">
            <strong>FanArt: {{ $contenido->created_at }}</strong>
        </div>
        <div class="card-body">
             <div class="embed-responsive embed-responsive-21by9">
                <iframe class="embed-responsive-item" src="{{ url($contenido->link) }}"></iframe>
              </div>
            <br> <br>
            <button class="btn btn-success aceptarYoutube{{ $contenido->id }}"
                data-usuarioId="{{ $contenido->user_id }}" data-youtubetId="{{ $contenido->id }}">
                Aceptar
            </button>
            <button class="btn btn-danger eliminarYoutube{{ $contenido->id }}"
                data-usuarioId="{{ $contenido->user_id }}" data-youtubeId="{{ $contenido->id }}">
                Eliminar
            </button>
        </div>
        <script>
            $(document).ready(function() {
                $('.eliminarYoutube{{ $contenido->id }}').on('click', function() {
                    let usuarioId = $(this).attr('data-usuarioId');
                    let youtubeId = $(this).attr('data-youtubeId');

                    $.ajax({
                        url: "{{ route('eliminar.youtube.creator') }}",
                        method: 'GET',
                        data: {
                            usuarioId: usuarioId,
                            youtubeId: youtubeId,
                        },
                        success: function(data) {
                            cargarCreadorYoutube();
                        }
                    })
                });
                $('.aceptarYoutube{{ $contenido->id }}').on('click', function() {
                    let usuarioId = $(this).attr('data-usuarioId');
                    let youtubeId = $(this).attr('data-youtubetId');

                    $.ajax({
                        url: "{{ route('aceptar.youtube.creator') }}",
                        method: 'GET',
                        data: {
                            usuarioId: usuarioId,
                            youtubeId: youtubeId,
                        },
                        success: function(data) {
                            cargarCreadorYoutube();
                        }
                    })
                });

                function cargarCreadorYoutube() {
                    $.ajax({
                        url: "{{ route('solicitud.youtube') }}",
                        method: "GET",
                        success: function(data) {
                            $('#cargarCreadorYoutube').html(data.content);
                        }
                    })
                }
            });

        </script>
    </div>
    <br>
@endforeach