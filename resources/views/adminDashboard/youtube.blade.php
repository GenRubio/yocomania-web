<div class="d-flex justify-content-center">
    <h3><strong>YouTube Manager</strong></h3>
</div>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-crear-youtube-tab" data-toggle="tab" href="#nav-crear-youtube"
            role="tab" aria-controls="nav-crear-youtube" aria-selected="true">Crear</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-crear-youtube" role="tabpanel"
        aria-labelledby="nav-crear-youtube-tab">
        <br>
        <div class="p-2">
            <div id="succesAddYoutube" class="alert alert-success" role="alert"></div>
            <form id="crearYoutube" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Url</label>
                    <input name="linkYoutube" type="text" class="form-control"
                        placeholder="Formato: https://www.youtube.com/embed/3fItSOolRj8">
                    <small class="form-text text-muted">La url de YouTube es la url que aparece al dar click en
                        Compartir video!!!<br>Ejemplo: https://youtu.be/zEIsG6XGltE</small>
                    <span id="linkYoutubeError" style="color:red" class="help-block"></span>
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#succesAddYoutube").fadeOut();
        $("#crearYoutube").on('submit', function(event) {
            event.preventDefault();
            $("#descripcionError").fadeOut();
            $("#imagenError").fadeOut();
            $("#succesAddScreenshot").fadeOut();

            $.ajax({
                url: "{{ route('create.youtube') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#succesAddYoutube").fadeIn();
                    $("#succesAddYoutube").text(data.result);
                    $("#crearYoutube")[0].reset();
                },
                error: function(error) {
                    if (error.responseJSON.errors.linkYoutube) {
                        $("#linkYoutubeError").text(error.responseJSON.errors
                                .linkYoutube)
                            .fadeIn();
                    }
                }
            })
        });
    });
</script>
