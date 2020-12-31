@foreach ($contenidos as $contenido)
    <div class="card">
        <div class="card-header">
            <strong>Screenshot: {{ $contenido->created_at }}</strong>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $contenido->descripcion }}</p>
            <img src="{{ url($contenido->link) }}" height="400" , width="700">
            <br> <br>
            <button class="btn btn-success aceptarScreenshot{{ $contenido->id }}"
                data-usuarioId="{{ $contenido->user_id }}" data-screenId="{{ $contenido->id }}">
                Aceptar
            </button>
            <button class="btn btn-danger eliminarScreenshot{{ $contenido->id }}"
                data-usuarioId="{{ $contenido->user_id }}" data-screenId="{{ $contenido->id }}">
                Eliminar
            </button>
        </div>
        <script>
            $(document).ready(function() {
                $('.eliminarScreenshot{{ $contenido->id }}').on('click', function() {
                    let usuarioId = $(this).attr('data-usuarioId');
                    let screenId = $(this).attr('data-screenId');

                    $.ajax({
                        url: "{{ route('eliminar.screenshot.creator') }}",
                        method: 'GET',
                        data: {
                            usuarioId: usuarioId,
                            screenId: screenId,
                        },
                        success: function(data) {
                            cargarCreadorScreenshot();
                        }
                    })
                });
                $('.aceptarScreenshot{{ $contenido->id }}').on('click', function() {
                    let usuarioId = $(this).attr('data-usuarioId');
                    let screenId = $(this).attr('data-screenId');

                    $.ajax({
                        url: "{{ route('aceptar.screenshot.creator') }}",
                        method: 'GET',
                        data: {
                            usuarioId: usuarioId,
                            screenId: screenId,
                        },
                        success: function(data) {
                            cargarCreadorScreenshot();
                        }
                    })
                });

                function cargarCreadorScreenshot() {
                    $.ajax({
                        url: "{{ route('solicitud.screenshots') }}",
                        method: "GET",
                        success: function(data) {
                            $('#cargarCreadorScreenshot').html(data.content);
                        }
                    })
                }
            });

        </script>
    </div>
    <br>
@endforeach
