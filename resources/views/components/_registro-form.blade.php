<div class="card">
    <div class="card-body" style="background-color: #c6481d45;">
        <form id="formularioRegistro" method="POST" action="{{ route('registry.account') }}">
            @csrf
            <div class="form-group">
                <label for="nombre" style="color: #19a8d1">
                    <strong>
                        Nombre de Usuario:
                    </strong>
                </label>
                <span id="nombreRegistroError" style="color:red" class="help-block"></span>
                <input name="nombre" type="text" maxlength="13" class="form-control" id="nombre"
                    aria-describedby="nombre" placeholder="Tu nombre en el juego..." required>
                <small id="nombreHelp" class="form-text text-muted" style="color: black;">Tu nombre único en
                    Yocomania.</small>
            </div>
            <div class="form-group">
                <label for="email" style="color: #19a8d1">
                    <strong>
                        Correo electrónico:
                    </strong>
                </label>
                <span id="emailRegistroError" style="color:red" class="help-block"></span>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Escribe aquí tu correo..." required>
                <small id="emailHelp" class="form-text text-muted" style="color: black;">Necesitaremos esta información
                    para restaurar su
                    cuenta en caso de que pierda el acceso.</small>
            </div>
            <div class="form-group">
                <label for="password" style="color: #19a8d1">
                    <strong>
                        Contraseña:
                    </strong>
                </label>
                <span id="passwordRegistroError" style="color:red" class="help-block"></span>
                <input name="password" type="password" minlength="6" minlength="20" class="form-control" id="password"
                    aria-describedby="password" placeholder="Contraseña..." required>
                <small id="passwordHelp" class="form-text text-muted" style="color: black;">Su contraseña debe tener al
                    menos 6 caracteres y maximo de 20.<br> <strong>¡Asegúrese de que su contraseña sea
                        diferente a la
                        de otros sitios web!</strong></small>
            </div>
            <div class="form-group">
                <label for="password" style="color: #19a8d1">
                    <strong>
                        Repite la contraseña:
                    </strong>
                </label>
                <span id="passwordRepeatRegistroError" style="color:red" class="help-block"></span>
                <input name="passwordRepeat" type="password" minlength="6" class="form-control" id="passwordRepeta"
                    aria-describedby="passwordRepeta" placeholder="Repite la contraseña..." required>
            </div>
            <label for="personaje" style="color: #19a8d1">
                <strong>
                    Escoge tu personaje:
                </strong>
            </label>
            <span id="avatarRegistroError" style="color:red" class="help-block"></span>
            <div class="cc-selector">
                <div class="row">
                    <div class="col p-0">
                        <input id="nerd" type="radio" name="avatar" value="1" checked />
                        <label class="drinkcard-cc nerd" for="nerd"></label>
                    </div>
                    <div class="col p-0">
                        <input id="vieja" type="radio" name="avatar" value="2" />
                        <label class="drinkcard-cc vieja" for="vieja"></label>
                    </div>
                    <div class="col p-0">
                        <input id="rasta" type="radio" name="avatar" value="3" />
                        <label class="drinkcard-cc rasta" for="rasta"></label>
                    </div>
                    <div class="col p-0">
                        <input id="viejo" type="radio" name="avatar" value="4" />
                        <label class="drinkcard-cc viejo" for="viejo"></label>
                    </div>
                    <div class="col p-0">
                        <input id="endia" type="radio" name="avatar" value="5" />
                        <label class="drinkcard-cc endia" for="endia"></label>
                    </div>
                    <div class="col p-0">
                        <input id="mafioso" type="radio" name="avatar" value="6" />
                        <label class="drinkcard-cc mafioso" for="mafioso"></label>
                    </div>
                    <div class="col p-0">
                        <input id="zeta" type="radio" name="avatar" value="7" />
                        <label class="drinkcard-cc zeta" for="zeta"></label>
                    </div>
                    <div class="col p-0">
                        <input id="gata" type="radio" name="avatar" value="8" />
                        <label class="drinkcard-cc gata" for="gata"></label>
                    </div>
                    <div class="col p-0">
                        <input id="boomer" type="radio" name="avatar" value="9" />
                        <label class="drinkcard-cc boomer" for="boomer"></label>
                    </div>
                    <div class="col p-0">
                        <input id="DJ" type="radio" name="avatar" value="10" />
                        <label class="drinkcard-cc DJ" for="DJ"></label>
                    </div>
                    <div class="col p-0">
                        <input id="bruja" type="radio" name="avatar" value="11" />
                        <label class="drinkcard-cc bruja" for="bruja"></label>
                    </div>
                </div>
            </div>
            <hr>
            <br>
            <div class="d-flex justify-content-center">
                <div class="form-check">
                    <input name="terminos" class="form-check-input" type="checkbox" value="ok" id="defaultCheck1" required>
                    <label class="form-check-label" for="defaultCheck1" style="color: black">
                        <strong>Acepto los <a href="#" data-toggle="modal" data-target="#terminosModal">Términos y
                                condiciones</a></strong>
                    </label>
                    <br>
                    <span id="terminosRegistroError" style="color:red" class="help-block"></span>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn-block">
                <strong>
                    CREAR MI CUENTA
                </strong>
            </button>
        </form>
        <div class="modal fade" id="terminosModal" tabindex="-1" role="dialog" aria-labelledby="terminosModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="terminosModalLongTitle" style="color: black"><strong>Términos y
                                condiciones
                                legales</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="color: black">
                        <p>El operador de este sitio web es Yocomania Interactive Entertainment
                            Europe Ltd. Nosotros operamos
                            diversos sitios web con muchas y diferentes funciones. Estas Condiciones de Uso establecen
                            la forma cómo puedes usar nuestros sitios web, aunque no todas las funciones estarán
                            disponibles en todos los sitios. Nuestros sitios pueden estar disponibles sólo en algunos
                            países e idiomas. Al usar este sitio, te comprometes a aceptar estas condiciones. Nos
                            reservamos el derecho de modificar estas Condiciones de Uso periódicamente, por lo que
                            deberás visitar esta página de vez en cuando por si se produjeran cambios. Se aplicarán
                            condiciones adicionales si haces una compra a través de nuestros sitios o, en algunos casos,
                            a funciones o promociones en particular. Si infringes estas Condiciones de Uso, sin
                            perjuicio de nuestros otros derechos y recursos, podemos tomar medidas contra tu cuenta,
                            incluida la prohibición de tu cuenta, en particular si percibimos una amenaza para nuestra
                            reputación, nuestra red o nuestros consumidores.
                        </p>
                        <p><strong>1. Requisitos de Edad</strong></p>
                        <p>Algunos de los contenidos que ofrecemos en nuestros sitios podrían no ser adecuados para
                            niños menores de cierta edad. En algunos casos aparecerán las clasificaciones para indicar
                            la aptitud del contenido; o se puede restringir el acceso a ciertos grupos de edad. Los
                            padres y tutores deberán supervisar el acceso de sus hijos a nuestros sitios y, en
                            particular, su uso de cualquier área de la comunidad.
                        </p>
                        <p><strong>2. Propiedad Intelectual</strong></p>
                        <p>Todos los derechos de propiedad intelectual de la información y de los contenidos de este
                            sitio web pertenecen a Yocomania o a los otorgantes de licencias. Gran parte de los
                            contenidos están protegidos por las leyes de derechos de autor y de marca registrada, entre
                            otras. Sólo se autoriza la realización de copias destinadas al uso personal a menos que se
                            indique lo contrario. Se prohíbe la modificación, reproducción, publicación o transferencia
                            de cualquier contenido a otras personas, o su uso para fines comerciales. Excepto en la
                            medida en que la ley vigente lo permita, está prohibido desensamblar, descompilar, aplicar
                            ingeniería inversa o intentar por cualquier medio romper la protección del contenido.
                        </p>
                        <p><strong>3. Disponibilidad</strong></p>
                        <p>Nuestros sitios se ponen a disposición “tal cual”. A veces es posible que los sitios no estén
                            disponibles, o pueden sufrir averías, mantenimiento u otras causas ajenas a nuestro control.
                            No se ofrece garantía alguna de la calidad, funcionalidad, disponibilidad o rendimiento de
                            nuestros sitios ni del contenido de los mismos. Nos reservamos el derecho a cambiar,
                            suspender o retirar cualquier contenido de nuestros sitios, suspender tu registro o acceso a
                            nuestros sitios o descontinuar cualquier función del sitio en cualquier momento sin aviso.
                            Eres responsable del pago de las tarifas de tu Proveedor del Servicio de Internet y de
                            cualquier tarifa relaciona con el uso de nuestros sitios.
                            <br>
                            No debes dañar, interferir o interrumpir el acceso a nuestros sitios o su contenido, ni
                            hacer nada que pueda afectar el funcionamiento o interferir con el acceso de los demás a
                            nuestros sitios o su contenido. No debes usar los sitios o su contenido de ninguna forma que
                            sea ilegal o perjudicial para Yocomania, nuestras empresas filiales o cualquier otra persona.
                        </p>
                        <p><strong>4. Comunidad</strong></p>
                        <p>Eres totalmente responsable de cualquier texto, vídeo, audio, imágenes, fotografías o
                            cualquier otro material o contenido que subas a nuestros sitios. Te rogamos que uses
                            cualquier herramienta de comunidad a tu disposición de forma responsable. En particular, al
                            interactuar con nosotros u otros usuarios (que pueden ser niños), debes comportarte de forma
                            legal, decente, respetuosa y considerada. Esto incluye el uso de cualquier característica de
                            intercambio o comunicación que te permita compartir mensajes, comentarios, imágenes,
                            fotografías, vídeos, material de juego, vídeos de juegos y otros materiales o información, e
                            incluye tus comunicaciones con nuestros servicios al cliente y otros empleados y agentes a
                            través de correo electrónico, teléfono u otros medios.
                            <br>
                            Por ejemplo:<br>
                            <strong>No compartas nada que sea vulgar ni use las funciones de la comunidad para perjudicar o
                            asustar a nadie;<br>
                            No compartas nada de que sea difamatorio u ofensivo (incluyendo todo aquello que pueda
                            resultar ofensivo desde un punto de vista racial, étnico, religioso o sexual);<br>
                            No uses o promuevas un lenguaje o comportamiento violento y substancias ilegales.<br>
                            No realices amenazas violentas ni promociones la violencia, como hacer apología del
                            terrorismo o amenazar.<br>
                            No deberás acosar, insultar o intimidar, ni suplantar o invadir la intimidad de nadie;<br>
                            No envíes correos de spam ni reenvíes recomendaciones/ofertas a tus contactos sin su
                            permiso;<br>
                            No hagas trampas ni saques provecho de cualquier error, fallo o vulnerabilidad de los
                            sitios;<br>
                            No compartas, comercies, suplantes ni recopiles datos personales o confidenciales;<br>
                            No uses nuestros sitios ni los asocies con ninguna actividad comercial;<br>
                            No actúes de ninguna forma que infrinjas la privacidad o los derechos de propiedad
                            intelectual:<br>
                            No lleves a cabo, o intentes o amenaces con realizar, ninguna actividad que vaya en contra
                            de estos términos de servicio o la ley aplicable y<br>
                            Usa el sentido común y conserva las buenas formas todo el tiempo.<br>
                            Nos otorgas un derecho perpetuo, mundial, no exclusivo, libre de cánones y totalmente
                            transferible para usar, copiar, modificar, publicar y presentar cualquier contenido que
                            publiques o subas a nuestros sitios, e incorporarlo en otras obras. Renuncias a cualquier
                            derecho moral que puedas tener en este contenido.</strong>
                            <br> <br>
                            Debes comprender que no controlamos todo el contenido generado por el usuario en nuestros
                            sitios y no tenemos ninguna obligación de hacerlo. Sin embargo, nos reservamos el derecho de
                            controlar cualquier contenido, sin ningún aviso, para editar, borrar o eliminar cualquier
                            contenido que consideremos inadecuado. Las opiniones expresadas en las áreas de la comunidad
                            son aquellas de los miembros del público y no las de Yocomania, nuestras empresas filiales,
                            otorgantes de licencias o socios. Incluimos mecanismos de denuncia de quejas donde pensamos
                            que podrían ser más relevantes. Si experimentas algún comportamiento inaceptable o
                            inapropiado en nuestros sitios, infórmanos de ello a través de la herramienta de denuncia de
                            quejas más cercana. Cuando envíes la denuncia, también podrás enviar pruebas pertinentes que
                            nos ayudarán a evaluarla. Por supuesto, esto significa que otras personas pueden presentar
                            una queja sobre ti y tu contenido generado por el usuario.
                        </p>
                        <p><strong>5. Enlaces a otros sitios</strong></p>
                        <p>No hemos aprobado ni examinado ningún sitio de terceros que tengan enlaces a nuestros sitios
                            y no nos hacemos responsables en ninguna forma por su contenido. El uso que hagas de estos
                            sitios de terceros estará sujeto a los términos y condiciones de dichos sitios.
                        </p>
                        <p><strong>6. Renuncia</strong></p>
                        <p>Yocomania no garantiza la exactitud, fiabilidad o totalidad de ninguna información contenida
                            en nuestros sitios. En todo el ámbito permitido por la ley, Yocomania, nuestras empresas
                            filiales y/o otorgantes de licencias excluyen toda responsabilidad por cualquier pérdida que
                            puedas sufrir tú o cualquier otro directa o indirectamente, incidental o consecuente y de la
                            forma que surja por tu uso o acceso, o imposibilidad de usar o acceder, incluida cualquier
                            pérdida de datos o daño causado por bajar contenido de nuestros sitios.
                            <br>
                            Puedes tener derechos como consumidor que no se ven afectados por estas Condiciones de Uso.
                            Si cualquier cláusula de estas Condiciones de Uso se considera ilegal, nula o no ejecutable,
                            el resto de las cláusulas continuarán en completo vigor y efecto.
                        </p>
                        <p><strong>7. Ley vigente</strong></p>
                        <p>Estas Condiciones de Uso están gobernadas por la ley de Estados Unidos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<script>
    $(document).ready(function() {
        $("#formularioRegistro").on('submit', function(event) {
            event.preventDefault();
            $("#nombreRegistroError").fadeOut();
            $("#emailRegistroError").fadeOut();
            $("#passwordRegistroError").fadeOut();
            $("#passwordRepeatRegistroError").fadeOut();
            $("#avatarRegistroError").fadeOut();
            $("#terminosRegistroError").fadeOut();

            $.ajax({
                url: "{{ route('registry.account') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#formularioRegistro")[0].reset();
                    location.href = "{{ route('me') }}";
                },
                error: function(error) {
                    if (error.responseJSON.errors.nombre) {
                        $("#nombreRegistroError").text(error.responseJSON.errors
                                .nombre[0])
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.email) {
                        $("#emailRegistroError").text(error.responseJSON.errors
                                .email)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.password) {
                        $("#passwordRegistroError").text(error.responseJSON.errors
                                .password)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.passwordRepeat) {
                        $("#passwordRepeatRegistroError").text(error.responseJSON.errors
                                .passwordRepeat)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.avatar) {
                        $("#avatarRegistroError").text(error.responseJSON.errors
                                .avatar)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.terminos) {
                        $("#terminosRegistroError").text(error.responseJSON.errors
                                .terminos)
                            .fadeIn();
                    }
                }
            })
        });
    });

</script>
