<script type="text/javascript" src="{{ asset('js/play/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/play/swfobject.js') }}"></script>
<script type="text/javascript">
    (function() {
        var flashvars = {
            sw1: '',
            sw2: '',
            sw3: '',
            sw4: '',
            sw5: '0',
            lang: 'e',
            locale: 'es_ES',
            ver: '4828183737',
        };
        var params = {
            play: 'true',
            loop: 'false',
            quality: 'high',
            allowscriptaccess: 'always',
            allowFullScreen: 'true',
            bgcolor: '#0099cc',
        };
        var attributes = {
            id: 'flash_boombang'
        };
        swfobject.embedSWF(
            "{{ url('/static/BBLoader.swf') }}",
            'flash_boombang',
            '100%',
            '657px;',
            '9.0.115',
            './http://boombang.tv/swfobject/expressInstall.swf/',
            flashvars, params, attributes
        );
    })();

</script>
<div id="fb-root"></div>
<div id="bb_swf_container" style="min-height: 657px;">
    <object type="application/x-shockwave-flash" id="flash_boombang">
        <param name="movie" id="flash_boombang" />
        <div class="container p-3">
            <div class="alert alert-danger shadow" role="alert">
                <div class="d-flex justify-content-center">
                    <strong>OCURRIÓ UN ERROR</strong>
                </div>
            </div>
            <div class="container">
                <div class="shadow">
                    <div class="d-flex justify-content-center p-3 rounded">
                        <strong>Si estás usando un ordenador necesitas <a
                                href="https://www.adobe.com/products/flashplayer/end-of-life.html"
                                target="_blank">permitir, instalar o
                                actualizar Flash</a> para jugar
                            Yocomania. Por favor <a href="https://www.adobe.com/products/flashplayer/end-of-life.html"
                                target="_blank">HAZ CLIC AQUÍ</a> para usar Flash. NOTA: Si tienes bloqueado Flash,
                            necesitarás ir a
                            los ajustes de tu navegador y desbloquear esa opción para poder jugar Yocomania.
                        </strong>
                    </div>
                    <div class="d-flex justify-content-center p-2 rounded">
                        <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#chrome"
                            style="background-color: #43a546;"><strong>Google Chrome</strong></button>

                        <div class="modal fade" id="chrome" tabindex="-1" role="dialog"
                            aria-labelledby="chromeLabel" aria-hidden="true">
                            <div class="modal-dialog play-modal" role="document" style="width: 970px">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="chromeLabel">¿Como permitir Flash en Google Chrome?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    hola
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary m-1"
                            style="background-color: #de5b26;"><strong>Mozilla Firefox</strong></button>
                        <button type="button" class="btn btn-primary m-1"
                            style="background-color: #ad0912;"><strong>Opera</strong></button>
                        <button type="button" class="btn btn-primary m-1"
                            style="background-color: #0d4fb7;"><strong>Safari</strong></button>
                    </div>
                    <div class="d-flex justify-content-center p-2 rounded">
                        <a href="{{ route('download.launcher') }}" type="button" class="btn btn-primary btn-lg"><strong>Descargar
                                Yocomania</strong></a>
                    </div>
                    <div class="d-flex justify-content-center p-3 rounded">
                        <strong>Si tienes un iPad, iPhone o Android puedes descargar la siguiente aplicación para jugar
                            Yocomania.
                        </strong>
                    </div>
                    <div class="d-flex justify-content-center p-3 rounded">
                        <a href="https://apps.apple.com/fr/app/puffin-web-browser/id472937654" target="_blank">
                            <img src="{{ url('/images/dashboarSVG/download-on-the-app-store-badge.png') }}" height="65"
                                , width="180">
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=com.cloudmosa.puffinFree&hl=fr"
                            target="_blank">
                            <img src="{{ url('/images/dashboarSVG/get-it-on-google-play-vector.png') }}" height="65" ,
                                width="180">
                        </a>
                    </div>
                    <hr>
                    <!-- Botones de descarga para las plataformas mobil-->
                    <div class="p-3 rounded">

                        <div class="row">
                            <div class="col">
                                <strong>
                                    <a href="https://support.google.com/chrome/a/answer/7084871?hl=es"
                                        target="_blank">Google
                                        Chrome</a> Nota
                                    importante: Adobe® ha anunciado que Flash® Player® dejará de estar
                                    disponible en diciembre del 2020. Esta función está desactivada de forma
                                    predeterminada en
                                    Chrome 76 y versiones posteriores.
                                </strong>
                                <br>
                                <strong>
                                    <strong style="color:#ff9900;">Recuerda</strong> que puedes acceder desde otros
                                    navegadores como Opera, Firefox o puedes descargar Yocomania!!!
                                </strong>
                            </div>
                            <div class="col-md-auto">
                            </div>
                            <div class="col">
                                <img src="{{ url('/images/dashboarSVG/playNoFlash.svg') }}" height="150" , width="180">
                                <img src="{{ url('/images/dashboarSVG/boomerRoza.svg') }}" height="150" , width="140">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </object>
</div>
<script>
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        document.getElementById("bb_swf_container").style.height = "657px";
        document.getElementById("bb_swf_container").style.width = "1012px";
    }

</script>
