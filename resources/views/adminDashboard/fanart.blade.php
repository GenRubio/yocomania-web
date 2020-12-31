<div class="d-flex justify-content-center">
    <h3><strong>Fanart Manager</strong></h3>
</div>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-crear-fanart-tab" data-toggle="tab" href="#nav-crear-fanart"
            role="tab" aria-controls="nav-crear-fanart" aria-selected="true">Crear</a>
        <a class="nav-item nav-link" id="nav-creador-fanart-tab" data-toggle="tab" href="#nav-creador-fanart" role="tab"
            aria-controls="nav-creador-fanart" aria-selected="true">Creador Contenido</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-creador-fanart" role="tabpanel" aria-labelledby="nav-crear-fanart-tab">
        <br>
        <div id="cargarCreadorFanart"></div>
    </div>
    <div class="tab-pane fade show active" id="nav-crear-fanart" role="tabpanel" aria-labelledby="nav-crear-fanart-tab">
        <br>
        <div class="p-2">
            <div id="succesAddFanart" class="alert alert-success" role="alert"></div>
            <form id="crearFanart" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Descripcion</label>
                    <input name="descripcionFanart" type="text" class="form-control" placeholder="Descripcion"
                        maxlength="75">
                    <small class="form-text text-muted">La maxima logitud de texto es de 75
                        caracteres.</small>
                    <span id="descripcionFanartError" style="color:red" class="help-block"></span>
                </div>
                <div class="form-group">
                    <label>Fan Art Imagen</label>
                    <input name="imagenFanart" type="file" class="form-control-file" id="exampleFormControlFile1">
                    <span id="imagenFanartError" style="color:red" class="help-block"></span>
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        cargarCreadorFanart();

        function cargarCreadorFanart() {
            $.ajax({
                url: "{{ route('solicitud.fanart') }}",
                method: "GET",
                success: function(data) {
                    $('#cargarCreadorFanart').html(data.content);
                }
            })
        }

        $("#succesAddFanart").fadeOut();
        $("#crearFanart").on('submit', function(event) {
            event.preventDefault();
            $("#descripcionFanartError").fadeOut();
            $("#imagenFanartError").fadeOut();
            $("#succesAddFanart").fadeOut();

            $.ajax({
                url: "{{ route('create.fanart') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#succesAddFanart").fadeIn();
                    $("#succesAddFanart").text(data.result);
                    $("#crearFanart")[0].reset();
                },
                error: function(error) {
                    if (error.responseJSON.errors.imagenFanart) {
                        $("#imagenFanartError").text(error.responseJSON.errors
                                .imagenFanart[0])
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.descripcionFanart) {
                        $("#descripcionFanartError").text(error.responseJSON.errors
                                .descripcionFanart)
                            .fadeIn();
                    }
                }
            })
        });
    });

</script>
