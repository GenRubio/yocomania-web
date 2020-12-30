<br>
<div class="container shadow-lg rounded p-3" style="background-color: white;">
    <div class="d-flex justify-content-center">
        <h3><strong>¿Quieres ayudar a Yocomania a crecer?</strong></h3>
    </div>
    <div class="d-flex justify-content-center">
        <p><strong>¡Publica capturas de pantalla del juego, dibujos realizados por ti o tus videos de YouTube y gana
                Créditos de
                oro!</strong></p>
    </div>
    <p>Por cada contenido que subas obtendrás una cantidad de créditos determinada.<br>
        Recuerda que en todo contenido debe aparecer la ficha de tu personaje con el nombre.<br>
        En el caso de FanArt debe aparecer escrito el nombre de tu personaje.<br>
        Todo contenido es revisado por la administración antes de ser publicado. Una vez que pase la validación los
        créditos aparecerán en tu cuenta y te llegara un mensaje en el apartado de Soporte.<br>
    </p>
    <div class="d-flex justify-content-center">
        <a type="button" data-toggle="modal" data-target="#terminosCreador"
            style="text-decoration: none; color:#3490dc;">
            <strong>Términos y Condiciones</strong>
        </a>
    </div>
    <div class="modal fade" id="terminosCreador" tabindex="-1" role="dialog" aria-labelledby="terminosCreadorTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Términos y Condiciones</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Términos y Condiciones: Screenshot</strong><br>
                    1. Las capturas de pantalla deben ser de Yocomania.<br>
                    2. La imagen no debe contener fondo. Solo debe de mostrarse el contenido.<br>
                    3. Las capturas deben ser de tamaño del marco en cuál se encuentra el juego.<br>
                    4. Debe aparecer tu ficha en la captura con el nombre.<br>
                    5. El nombre debe ser el mismo desde cuál publicas este contenido.<br>
                    <strong>Términos y Condiciones: FanArt</strong><br>
                    1. Los dibujos deben contener escrito el nombre que tienes en Yocomania.<br>
                    2. El nombre debe ser el mismo desde cuál publicas este contenido.<br>
                    3. Los plagios de imágenes pueden conllevar a bloqueo permanente de tu cuenta.<br>
                    4. Los collage son considerados como dibujos.<br>
                    5. Los dibujos deben ser relacionados con Yocomania.<br>
                    <strong>Términos y Condiciones: video YouTube</strong><br>
                    1. Duración mínima del video 3 minutos.<br>
                    2. Debe aparecer la ficha de tu personaje con el nombre.<br>
                    3. El nombre debe ser el mismo desde cuál publicas este contenido.<br>
                    4. El video debe ser sobre Yocomania.<br>
                    <strong>Otros</strong><br>
                    1. Los moderadores pueden rechazar tu publicación aun que tu contenido cumpla
                    con las normas.<br>
                    2. Si se detecta plagio la cuenta puede ser desactivada para siempre.<br>
                    Si tienes alguna duda puedes escribir al Soporte de Yocomania :D estaremos
                    encantados de resolver tus dudas.<br>
                    <p style="color: #3490dc">El contenido sera publicado en la pagina principal de la Yocomania.</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <style>
        #drop_zone_screen {
            vertical-align: middle;
            text-align: center;
            padding: .3em;
            border: .2em dashed #ccc;
            border-radius: 1em;
            width: auto;
            min-height: 17em;
            margin: 0;
        }

        #drop_zone_fanart {
            vertical-align: middle;
            text-align: center;
            padding: .3em;
            border: .2em dashed #ccc;
            border-radius: 1em;
            width: auto;
            min-height: 17em;
            margin: 0;
        }

    </style>
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <div class="align-self-center">
                    <strong>Publicar Screenshot:</strong>
                </div>
                <div class="ml-2 align-self-center">
                    <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                </div>
                <div class="ml-2 align-self-center">
                    <strong style="color: #dc7e05;">250 Créditos</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form id="publicarScreenshot">
                        <div id="succesScreenshot" class="alert alert-success" role="alert"></div>
                        @csrf
                        <div id="drop_zone_screen"><strong>Puedes arrastrar la captura de pantalla aqui.</strong></div>
                        <br>
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><strong>Publicar</strong></button>
                    </form>
                </div>
                <div class="col-md-auto"></div>
                <div class="col col-lg-4">
                    <!-- imagen-->
                    <img src="{{ url('/images/creador/boomerCreador.svg') }}" height="250", width="180">
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container shadow-lg rounded p-3" style="background-color: white;">
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <div class="align-self-center">
                    <strong>Publicar FanArt:</strong>
                </div>
                <div class="ml-2 align-self-center">
                    <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                </div>
                <div class="ml-2 align-self-center">
                    <strong style="color: #dc7e05;">2.000 Créditos</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form id="publicarFanart">
                        <div id="succesFanart" class="alert alert-success" role="alert"></div>
                        @csrf
                        <div id="drop_zone_fanart"><strong>Puedes arrastrar el dibujo aqui.</strong></div>
                        <br>
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><strong>Publicar</strong></button>
                    </form>
                </div>
                <div class="col-md-auto"></div>
                <div class="col col-lg-4">
                    <!-- imagen-->
                    <img src="{{ url('/images/creador/NerdCreador.svg') }}" height="250", width="188">
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container shadow-lg rounded p-3" style="background-color: white;">
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <div class="align-self-center">
                    <strong>Publicar video YouTube:</strong>
                </div>
                <div class="ml-2 align-self-center">
                    <img src="{{ url('/images/perfil/monedasOro.png') }}" height="30" , width="30">
                </div>
                <div class="ml-2 align-self-center">
                    <strong style="color: #dc7e05;">3.000 Créditos</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form id="publicarVideo">
                        <div id="succesPublicarVideo" class="alert alert-success" role="alert"></div>
                        @csrf
                        <div class="form-group">
                            <label><strong>Link YouTube</strong></label>
                            <p>
                                AVISO: El enlace del video se obtiene al dar click en apartado Compartir.<br>
                                Para más información puedes contactar al Soporte de Yocomania.
                            </p>
                            <input type="text" class="form-control" placeholder="https://youtu.be/zEIsG6XGltE">
                            <small class="form-text text-muted">El link de video debe tener este formato:
                                https://youtu.be/zEIsG6XGltE .</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><strong>Publicar</strong></button>
                    </form>
                </div>
                <div class="col-md-auto"></div>
                <div class="col col-lg-4">
                    <!-- imagen-->
                    <img src="{{ url('/images/creador/DJCreador.svg') }}" height="250", width="190">
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<script>
    $("#succesScreenshot").fadeOut();
    $("#succesFanart").fadeOut();
    $("#succesPublicarVideo").fadeOut();
</script>
