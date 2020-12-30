<div class="container">
    <div class="d-flex justify-content-center">
        <h3><strong>Support Menssages</strong></h3>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-responder-tab" data-toggle="tab" href="#nav-responder"
                role="tab" aria-controls="nav-responder" aria-selected="true"><strong>Bandeja Entrada</strong></a>
            <a class="nav-item nav-link" id="nav-mandar-tab" data-toggle="tab" href="#nav-mandar" role="tab"
                aria-controls="nav-mandar" aria-selected="false"><strong>Redactar</strong></a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-responder" role="tabpanel" aria-labelledby="nav-responder-tab">
            <br>
            <div id="mensajesSupporte"></div>
        </div>
        <div class="tab-pane fade" id="nav-mandar" role="tabpanel" aria-labelledby="nav-mandar-tab">
            <br>
            <form id="enviarMensajeSupport">
                @csrf
                <div id="succesSendSupportGlobal" class="alert alert-success" role="alert"></div>
                <div class="form-group">
                    <label>Razon de mensaje</label>
                    <input name="redactSubject" type="text" class="form-control" maxlength="25" id="exampleFormControlInput1"
                        placeholder="Texto de max 25 caracteres." required>
                </div>
                <div class="form-group">
                    <label>Mensaje global o para usuario especifico?:</label>
                    <select name="redactTipo" class="form-control" id="exampleFormControlSelect1">
                        <option value="one" selected>Usuario Especifico</option>
                        <option value="global">Mensaje Global</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nombre de usuario</label>
                    <small id="emailHelp" class="form-text text-muted">Deja este campo vacio si es un
                        mensaje global.</small>
                    <input name="redactUsuario" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre">
                    
                </div>
                <div class="form-group">
                    <label>Area de texto</label>
                    <textarea name="redactTexto" class="form-control" id="exampleFormControlTextarea1" rows="8" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block"><strong>Enviar</strong></button>
            </form>
        </div>
    </div>
</div>
<script>
    $("#succesSendSupportGlobal").fadeOut();
    $(document).ready(function() {
        obtenerSoporte();

        function obtenerSoporte() {
            $.ajax({
                url: "{{ route('admin.support') }}",
                method: "GET",
                success: function(data) {
                    $('#mensajesSupporte').html(data.content);
                }
            })
        }
        $(document).on('click', '.deleteSupport', function() {
            var id = $(this).attr('id');
            var _token = $(this).attr('_token');
            $.ajax({
                url: "{{ route('admin.support.delete') }}/" + id,
                method: "DELETE",
                data: {
                    id: id,
                    _token: _token
                },
                success: function(data) {
                    obtenerSoporte();
                }
            })
        });
        $("#enviarMensajeSupport").on('submit', function(event) {
            event.preventDefault();
            $("#succesSendSupportGlobal").fadeOut();
            $.ajax({
                url: "{{ route('admin.support.send') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#succesSendSupportGlobal").fadeIn();
                    $("#succesSendSupportGlobal").text(data.content);
                    $("#enviarMensajeSupport")[0].reset();
                }
            })
        });
    });

</script>
