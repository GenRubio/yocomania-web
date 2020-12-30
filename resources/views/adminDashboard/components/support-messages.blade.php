@if (count($supports) == 0)
    <div class="container">
        <div class="p-3 border shadow">
            <div class="d-flex justify-content-center">
                <h5><strong>No hay mensajes</strong></h5>
            </div>
        </div>
    </div>
@endif
@foreach ($supports as $support)
    <div class="p-3 m-2 border rounded shadow">
        <div class="d-flex justify-content-between">
            <div class="align-self-center">
                <i>{{ $support->created_at }} --> </i><strong style="color: #3490dc;">{{ $support->subject }}</strong>,
                {{ $support->user_name }}
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal"
                    data-target="#supportM{{ $support->id }}"><strong>Ver</strong></button>
                <div class="modal fade" id="supportM{{ $support->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="supportM{{ $support->id }}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="supportM{{ $support->id }}Label">Nuevo mensaje para
                                    {{ $support->user_name }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="enviarSupportMensaje{{ $support->id }}">
                                @csrf
                                <div class="modal-body">
                                    <div id="succesSendSupport{{ $support->id }}" class="alert alert-success" role="alert"></div>
                                    <p>Mensaje de {{ $support->user_name }}:</p>
                                    <p><strong>Tema:</strong> {{ $support->subject }}</p>
                                    <p><strong>Mensaje:</strong> {{ $support->comentario }}</p>

                                    <input type="hidden" name="usuario" value="{{ $support->user_id }}">
                                    <input type="hidden" name="subject" value="{{ $support->subject }}">
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Redactar respuesta:</label>
                                        <textarea name="supportMensaje" rows="8" class="form-control"
                                            id="message-text" required></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Enaviar mensaje</button>
                                </div>
                            </form>
                            <script>
                                $("#succesSendSupport{{ $support->id }}").fadeOut();
                                $(document).ready(function() {

                                    $("#enviarSupportMensaje{{ $support->id }}").on('submit', function(event) {
                                        event.preventDefault();
                                        $.ajax({
                                            url: "{{ route('admin.support.send.one') }}",
                                            method: 'POST',
                                            data: new FormData(this),
                                            dataType: 'json',
                                            contentType: false,
                                            cache: false,
                                            processData: false,
                                            success: function(data) {
                                                $("#succesSendSupport{{ $support->id }}").text(data.content);
                                                $("#succesSendSupport{{ $support->id }}").fadeIn();
                                            }
                                        })
                                    });
                                });

                            </script>
                        </div>
                    </div>
                </div>
                <button id="{{ $support->id }}" _token="{{ csrf_token() }}" type="submit"
                    class="btn btn-danger deleteSupport">
                    <strong>Eliminar</strong>
                </button>
            </div>
        </div>
    </div>
@endforeach
