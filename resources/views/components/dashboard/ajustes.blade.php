<br>
<div class="container shadow-lg rounded p-3" style="background-color: white;">
    <div class="card">
        <div class="card-header">
            <strong>Cambiar contraseña</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form id="cambiarPassword">
                        <div id="succesCambiarPassword" class="alert alert-success" role="alert"></div>
                        @csrf
                        <div class="form-group">
                            <label><strong style="color: #3490dc">Contraseña actual:</strong></label>
                            <span id="passwordError" style="color:red" class="help-block"></span>
                            <input name="password" type="password" class="form-control" placeholder="Contraseña actual">
                        </div>
                        <div class="form-group">
                            <label><strong style="color: #3490dc">Nueva contraseña:</strong></label>
                            <span id="passwordNuevaError" style="color:red" class="help-block"></span>
                            <input name="passwordNueva" type="password" class="form-control"
                                placeholder="Nueva contraseña">
                        </div>
                        <div class="form-group">
                            <label><strong style="color: #3490dc">Repite la nueva contraseña:</strong></label>
                            <span id="passwordRepeatError" style="color:red" class="help-block"></span>
                            <input name="passwordRepeat" type="password" class="form-control"
                                placeholder="Repite la nueva contraseña">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><strong>Cambiar</strong></button>
                    </form>
                </div>
                <div class="col-md-auto"></div>
                <div class="col col-lg-4">
                    <img src="{{ url('/images/dashboarSVG/gataBeso.svg') }}" width="215" , height="280">
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container shadow-lg rounded p-3" style="background-color: white;">
    <div class="card">
        <div class="card-header">
            <strong>Clave de Seguridad</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form id="cambiarSeguridad">
                        <div id="succesCambiarSeguridad" class="alert alert-success" role="alert"></div>
                        @csrf
                        <div class="form-group">
                            <label><strong style="color: #3490dc">Clave de seguridad actual:</strong></label>
                            <span id="claveSeguridadError" style="color:red" class="help-block"></span>
                            <input name="claveSeguridad" type="password" class="form-control"
                                placeholder="Clave de seguridad actual">
                        </div>
                        <div class="form-group">
                            <label><strong style="color: #3490dc">Nueva clave de seguridad:</strong></label>
                            <span id="claveSeguridadNuevaError" style="color:red" class="help-block"></span>
                            <input name="claveSeguridadNueva" type="password" class="form-control"
                                placeholder="Nueva clave de seguridad">
                        </div>
                        <div class="form-group">
                            <label><strong style="color: #3490dc">Repite la nueva clave de seguridad:</strong></label>
                            <span id="claveSeguridadRepeatError" style="color:red" class="help-block"></span>
                            <input name="claveSeguridadRepeat" type="password" class="form-control"
                                placeholder="Repite la nueva clave de seguridad">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><strong>Cambiar</strong></button>
                    </form>
                </div>
                <div class="col-md-auto"></div>
                <div class="col col-lg-4">
                    <img src="{{ url('/images/dashboarSVG/indiaFlor.svg') }}" width="205" , height="280">
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container shadow-lg rounded p-3" style="background-color: white;">
    <div class="card">
        <div class="card-header">
            <strong>Cambiar correo electrónico</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form id="cambiarEmail">
                        <div id="succesCambiarEmail" class="alert alert-success" role="alert"></div>
                        @csrf
                        <div class="form-group">
                            <label><strong style="color: #3490dc">Correo electrónico actual:</strong></label>
                            <span id="emailError" style="color:red" class="help-block"></span>
                            <input name="email" type="email" class="form-control" placeholder="Correo electrónico actual">
                        </div>
                        <div class="form-group">
                            <label><strong style="color: #3490dc">Nuevo correo electrónico:</strong></label>
                            <span id="emailNuevoError" style="color:red" class="help-block"></span>
                            <input name="emailNuevo" type="email" class="form-control" placeholder="Nuevo correo electrónico">
                        </div>
                        <div class="form-group">
                            <label><strong style="color: #3490dc">Repite el nuevo correo electrónico:</strong></label>
                            <span id="emailRepeatError" style="color:red" class="help-block"></span>
                            <input name="emailRepeat" type="email" class="form-control" placeholder="Repite el nuevo correo electrónico">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><strong>Cambiar</strong></button>
                    </form>
                </div>
                <div class="col-md-auto"></div>
                <div class="col col-lg-4">
                    <img src="{{ url('/images/dashboarSVG/rastaBeber.svg') }}" width="250" , height="350">
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<script>
    $(document).ready(function() {
        $("#succesCambiarPassword").fadeOut();
        $("#succesCambiarSeguridad").fadeOut();
        $("#succesCambiarEmail").fadeOut();

        $("#cambiarEmail").on('submit', function(event) {
            event.preventDefault();
            $("#emailError").fadeOut();
            $("#emailNuevoError").fadeOut();
            $("#emailRepeatError").fadeOut();
            $("#succesCambiarEmail").fadeOut();

            $.ajax({
                url: "{{ route('change.email') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#cambiarEmail")[0].reset();
                    $("#succesCambiarEmail").text(data.content);
                    $("#succesCambiarEmail").fadeIn();
                },
                error: function(error) {
                    if (error.responseJSON.errors.email) {
                        $("#emailError").text(error.responseJSON.errors
                                .email)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.emailNuevo) {
                        $("#emailNuevoError").text(error.responseJSON.errors
                                .emailNuevo)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.emailRepeat) {
                        $("#emailRepeatError").text(error.responseJSON.errors
                                .emailRepeat)
                            .fadeIn();
                    }
                }
            })
        });
        $("#cambiarSeguridad").on('submit', function(event) {
            event.preventDefault();
            $("#claveSeguridadError").fadeOut();
            $("#claveSeguridadNuevaError").fadeOut();
            $("#claveSeguridadRepeatError").fadeOut();
            $("#succesCambiarSeguridad").fadeOut();

            $.ajax({
                url: "{{ route('change.security') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#cambiarSeguridad")[0].reset();
                    $("#succesCambiarSeguridad").text(data.content);
                    $("#succesCambiarSeguridad").fadeIn();
                },
                error: function(error) {
                    if (error.responseJSON.errors.claveSeguridad) {
                        $("#claveSeguridadError").text(error.responseJSON.errors
                                .claveSeguridad)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.claveSeguridadNueva) {
                        $("#claveSeguridadNuevaError").text(error.responseJSON.errors
                                .claveSeguridadNueva)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.claveSeguridadRepeat) {
                        $("#claveSeguridadRepeatError").text(error.responseJSON.errors
                                .claveSeguridadRepeat)
                            .fadeIn();
                    }
                }
            })
        });
        $("#cambiarPassword").on('submit', function(event) {
            event.preventDefault();
            $("#passwordError").fadeOut();
            $("#passwordNuevaError").fadeOut();
            $("#passwordRepeatError").fadeOut();
            $("#succesCambiarPassword").fadeOut();

            $.ajax({
                url: "{{ route('change.passoword') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#cambiarPassword")[0].reset();
                    $("#succesCambiarPassword").text(data.content);
                    $("#succesCambiarPassword").fadeIn();
                },
                error: function(error) {
                    if (error.responseJSON.errors.password) {
                        $("#passwordError").text(error.responseJSON.errors
                                .password)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.passwordNueva) {
                        $("#passwordNuevaError").text(error.responseJSON.errors
                                .passwordNueva)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.passwordRepeat) {
                        $("#passwordRepeatError").text(error.responseJSON.errors
                                .passwordRepeat)
                            .fadeIn();
                    }
                }
            })
        });
    });

</script>
