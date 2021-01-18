<div class="row ml-0 mr-0">
    <div class="col col-lg-8 shadow-lg"
        style="border-bottom: 5px solid white;background-color: #c6481d; border-right: 5px solid white; border-left: 5px solid white; border-top: 5px solid white;">
        <div class="container px-md-5" style="background-color: #c6481d;color:white">
            <br>
            <div class="d-flex justify-content-center">
                <h1><strong>¿Propuestas o dudas?</strong></h1>
            </div>
            <div class="d-flex justify-content-center">
                <h1><strong>Contactenos</strong></h1>
            </div>
            *Intentaremos responderte lo antes posible via Email
            <br><br>
            <div id="succesAddContacto" class="alert alert-success" role="alert"></div>
            <div class="card">
                <div class="card-body" style="background-color: #c6481d45;">
                    <form id="formularioContacto">
                        @csrf
                        <div class="form-group">
                            <label for="nombre" style="color: #19a8d1">
                                <strong>
                                    Nombre:
                                </strong>
                            </label>
                            <span id="nombreError" style="color:red" class="help-block"></span>
                            <input name="nombre" type="text" maxlength="50" class="form-control" id="nombre"
                                aria-describedby="nombre" placeholder="Nombre">
                            <small id="nombreHelp" class="form-text text-muted" style="color: black;">Max 50 caracteres</small>
                        </div>
                        <div class="form-group">
                            <label for="email" style="color: #19a8d1">
                                <strong>
                                    Correo electrónico:
                                </strong>
                            </label>
                            <span id="emailError" style="color:red" class="help-block"></span>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Escribe aquí tu correo...">
                        </div>
                        <div class="form-group">
                            <label for="subject" style="color: #19a8d1">
                                <strong>
                                    Subject:
                                </strong>
                            </label>
                            <span id="subjectError" style="color:red" class="help-block"></span>
                            <input name="subject" type="text" maxlength="50" class="form-control" id="subject"
                                aria-describedby="subject" placeholder="Subject">
                            <small id="subjectHelp" class="form-text text-muted" style="color: black;">Max 100 caracteres</small>
                        </div>
                        <div class="form-group">
                            <label for="contenido" style="color: #19a8d1">
                                <strong>
                                    Descripcion:
                                </strong>
                            </label>
                            <span id="contenidoError" style="color:red" class="help-block"></span>
                            <textarea name="contenido" class="form-control" id="contenido" rows="3"></textarea>
                            <small id="contenidoHelp" class="form-text text-muted" style="color: black;">Max 255 caracteres</small>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">
                            <strong>
                                ENVIAR
                            </strong>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-auto"></div>
    <div class="col p-0" id="barraDerecha">
        @php
        $tag = "contacto";
        @endphp
        @include('layouts.home._barraDerecha', ['tag' => $tag])
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#succesAddContacto').fadeOut();
        $("#formularioContacto").on('submit', function(event) {
            event.preventDefault();
            $('#succesAddContacto').fadeOut();
            $('#nombreError').fadeOut();
            $('#emailError').fadeOut();
            $('#subjectError').fadeOut();
            $('#contenidoError').fadeOut();

            $.ajax({
                url: "{{ route('home.contacto') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#formularioContacto")[0].reset();
                    $('#succesAddContacto').text(data.content);
                    $('#succesAddContacto').fadeIn();
                },
                error: function(error) {
                    if (error.responseJSON.errors.nombre){
                        $("#nombreError").text(error.responseJSON.errors
                            .nombre[0])
                        .fadeIn();
                    }
                    if (error.responseJSON.errors.email) {
                        $("#emailError").text(error.responseJSON.errors
                                .email)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.subject) {
                        $("#subjectError").text(error.responseJSON.errors
                                .subject)
                            .fadeIn();
                    }
                    if (error.responseJSON.errors.contenido) {
                        $("#contenidoError").text(error.responseJSON.errors
                                .contenido)
                            .fadeIn();
                    }
                }
            })
        });
    });

</script>