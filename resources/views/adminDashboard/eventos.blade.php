<div class="d-flex justify-content-center">
    <h3><strong>Eventos Manager</strong></h3>
</div>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-crear-evento-tab" data-toggle="tab" href="#nav-crear-evento"
            role="tab" aria-controls="nav-crear-evento" aria-selected="true">Crear</a>
        <a class="nav-item nav-link" id="nav-borar-evento-tab" data-toggle="tab" href="#nav-borar-evento" role="tab"
            aria-controls="nav-borar-evento" aria-selected="false">Eliminar</a>

    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-crear-evento" role="tabpanel" aria-labelledby="nav-crear-evento-tab">
        <br>
        <div class="p-2">
            <div id="succesAddEvent" class="alert alert-success" role="alert"></div>
            <form id="crearEvento" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nombre Corto</label>
                    <input name="nombre" type="text" class="form-control" placeholder="Nombre Corto" maxlength="25">
                    <small class="form-text text-muted">La maxima logitud de texto es de 25
                        caracteres.</small>
                    <span id="nombreError" style="color:red" class="help-block"></span>
                </div>
                <div class="form-group">
                    <label>Titulo</label>
                    <input name="titulo" type="text" class="form-control" placeholder="Titulo" maxlength="40">
                    <small class="form-text text-muted">La maxima logitud de texto es de 40
                        caracteres.</small>
                    <span id="tituloError" style="color:red" class="help-block"></span>
                </div>
                <div class="form-group">
                    <label>Descripcion</label>
                    <textarea name="descripcion" class="form-control" rows="3"></textarea>
                    <span id="descripcionError" style="color:red" class="help-block"></span>
                </div>
                <div class="form-group">
                    <label>Fecha del evento</label>
                    <input name="fecha" class="form-control" type="datetime-local" id="tiempoEvento"
                        id="example-datetime-local-input">
                    <span id="fechaError" style="color:red" class="help-block"></span>
                </div>
                <div class="form-group">
                    <label>Imagen</label>
                    <input name="imagen" type="file" class="form-control-file" id="exampleFormControlFile1">
                    <span id="imagenError" style="color:red" class="help-block"></span>
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </form>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-borar-evento" role="tabpanel" aria-labelledby="nav-borar-evento-tab">
        <br>
        <div id="todosEventos" class="p-2"></div>
    </div>
</div>
<script>
    $(document).ready(function() {

        function setInputDate(_id) {
            var now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            document.getElementById('tiempoEvento').value = now.toISOString().slice(0, 16);
        };

        setInputDate("#tiempoEvento");
        obtenerEventos();

        function obtenerEventos(){
            $.ajax({
                url: "{{ route('eventos.search') }}",
                method: "GET",
                success:function(data){
                    $('#todosEventos').html(data.content);
                }
            })
        }

        $("#succesAddEvent").fadeOut();
        $("#crearEvento").on('submit', function(event) {
            event.preventDefault();
            $("#nombreError").fadeOut();
            $("#tituloError").fadeOut();
            $("#descripcionError").fadeOut();
            $("#fechaError").fadeOut();
            $("#imagenError").fadeOut();
            $("#succesAddEvent").fadeOut();

            $.ajax({
                url: "{{ route('create.event') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#succesAddEvent").fadeIn();
                    $("#succesAddEvent").text(data.result);
                    $("#crearEvento")[0].reset();
                    setInputDate("#tiempoEvento");
                    obtenerEventos();
                },
                error: function(error) {
                    if (error.responseJSON.errors.imagen) {
                        $("#imagenError").text(error.responseJSON.errors
                                .imagen[0])
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.nombre) {
                        $("#nombreError").text(error.responseJSON.errors
                                .nombre)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.titulo) {
                        $("#tituloError").text(error.responseJSON.errors
                                .titulo)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.descripcion) {
                        $("#descripcionError").text(error.responseJSON.errors
                                .descripcion)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.fecha) {
                        $("#fechaError").text(error.responseJSON.errors
                                .fecha)
                            .fadeIn();
                    }
                }
            })
        });
    });

</script>
