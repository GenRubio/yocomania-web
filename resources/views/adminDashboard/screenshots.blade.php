<div class="d-flex justify-content-center">
    <h3><strong>Screenshots Manager</strong></h3>
</div>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-crear-screenshot-tab" data-toggle="tab" href="#nav-crear-screenshot"
            role="tab" aria-controls="nav-crear-screenshot" aria-selected="true">Crear</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-crear-screenshot" role="tabpanel"
        aria-labelledby="nav-crear-screenshot-tab">
        <br>
        <div class="p-2">
            <div id="succesAddScreenshot" class="alert alert-success" role="alert"></div>
            <form id="crearScreenshot" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Descripcion</label>
                    <input name="descripcionScreen" type="text" class="form-control" placeholder="Descripcion"
                        maxlength="75">
                    <small class="form-text text-muted">La maxima logitud de texto es de 75
                        caracteres.</small>
                    <span id="descripcionScreenError" style="color:red" class="help-block"></span>
                </div>
                <div class="form-group">
                    <label>Screenshot</label>
                    <input name="imagenScreen" type="file" class="form-control-file" id="exampleFormControlFile1">
                    <span id="imagenScreenError" style="color:red" class="help-block"></span>
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#succesAddScreenshot").fadeOut();
        $("#crearScreenshot").on('submit', function(event) {
            event.preventDefault();
            $("#descripcionError").fadeOut();
            $("#imagenError").fadeOut();
            $("#succesAddScreenshot").fadeOut();

            $.ajax({
                url: "{{ route('create.screenshot') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#succesAddScreenshot").fadeIn();
                    $("#succesAddScreenshot").text(data.result);
                    $("#crearScreenshot")[0].reset();
                },
                error: function(error) {
                    if (error.responseJSON.errors.imagenScreen) {
                        $("#imagenScreenError").text(error.responseJSON.errors
                                .imagenScreen[0])
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.descripcionScreen) {
                        $("#descripcionScreenError").text(error.responseJSON.errors
                                .descripcionScreen)
                            .fadeIn();
                    }
                }
            })
        });
    });
</script>
