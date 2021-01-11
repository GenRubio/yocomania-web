<br>
<div class="container shadow-lg rounded p-3" style="background-color: white;min-height:618px;">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-redactar-tab" data-toggle="tab" href="#nav-redactar" role="tab"
                aria-controls="nav-redactar" aria-selected="true"><strong>Redactar</strong></a>
            <a class="nav-item nav-link" id="nav-bandeja-tab" data-toggle="tab" href="#nav-bandeja" role="tab"
                aria-controls="nav-bandeja" aria-selected="false"><strong>Mensajes recibidos</strong>
                @if ($mensajes > 0)
                    <span class="badge badge-success align-middle"><strong>{{ $mensajes }}</strong></span>
                @endif
            </a>
            <a class="nav-item nav-link" id="nav-reclamo-tab" data-toggle="tab" href="#nav-reclamo" role="tab"
                aria-controls="nav-reclamo" aria-selected="false"><strong style="color: #dc7e05;">Recuperar datos</strong>
            </a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-redactar" role="tabpanel" aria-labelledby="nav-redactar-tab">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-center">
                        <strong>Soporte técnico</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form id="enviarToketSupport">
                                <div id="succesEnviarToketSupport" class="alert alert-success" role="alert"></div>
                                @csrf
                                <div class="form-group">
                                    <label><strong style="color: #3490dc">Escoge el tema:</strong></label>
                                    <span id="subjectError" style="color:red" class="help-block"></span>
                                    <select name="subject" class="custom-select my-1 mr-sm-2"
                                        id="inlineFormCustomSelectPref">
                                        <option value="Error juego" selected>Error juego</option>
                                        <option value="Error web">Error web</option>
                                        <option value="Recomendacion">Recomendacion</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><strong style="color: #3490dc">Comentario:</strong></label>
                                    <span id="comentarioSupportError" style="color:red" class="help-block"></span>
                                    <textarea name="comentarioSupport" class="form-control" rows="11"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block"><strong>Enviar</strong></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" style="min-height: 300px" id="nav-bandeja" role="tabpanel"
            aria-labelledby="nav-bandeja-tab">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-center">
                        <strong>Bandeja de entrada</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div id="cargarSupportMessages"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade"  id="nav-reclamo" role="tabpanel"
            aria-labelledby="nav-reclamo-tab">
            <livewire:recuperar-datos/>
        </div>
    </div>
</div>
<br>
<script>
    $("#succesEnviarToketSupport").fadeOut();
    $(document).ready(function() {

        obtenerSupportMessages();


        function obtenerSupportMessages() {
            $.ajax({
                url: "{{ route('obtener.user.support.message') }}",
                method: "GET",
                success: function(data) {
                    $('#cargarSupportMessages').html(data.content);
                }
            });
        }
        $(document).on('click', '.deleteSupport', function() {
            var id = $(this).attr('id');
            var _token = $(this).attr('_token');
            $.ajax({
                url: "{{ route('user.support.delete') }}/" + id,
                method: "DELETE",
                data: {
                    id: id,
                    _token: _token
                },
                success: function(data) {
                    obtenerSupportMessages();
                }
            })
        });
        $("#enviarToketSupport").on('submit', function(event) {
            event.preventDefault();
            $("#subjectError").fadeOut();
            $("#comentarioSupportError").fadeOut();
            $("#succesEnviarToketSupport").fadeOut();

            $.ajax({
                url: "{{ route('user.send.support') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#succesEnviarToketSupport").fadeIn();
                    $("#succesEnviarToketSupport").text(data.result);
                    $("#enviarToketSupport")[0].reset();
                },
                error: function(error) {
                    if (error.responseJSON.errors.subject) {
                        $("#subjectError").text(error.responseJSON.errors
                                .subject)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.comentarioSupport) {
                        $("#comentarioSupportError").text(error.responseJSON.errors
                                .comentarioSupport)
                            .fadeIn();
                    }
                }
            })
        });
    });

</script>
