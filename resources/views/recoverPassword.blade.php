<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <link href="{{ url('/css/avatar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/eventoButtons.css') }}">
    {{-- JS Config --}}
    <script type="text/javascript">
        @include('partials.viewconfig.head_scripts')
        @yield('head_script')

    </script>
    <title>Yocomania</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
</head>

<body>
    <div class="recover-password-section-js"></div>
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <div style="background-image: url('{{ url('/images/homeBaner2.png') }}'); 
        background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row ml-0 mr-0">
                <div class="col-8">
                    @include('layouts.home._header-buttons')
                    <br>
                </div>
                <div class="col">
                    @include('layouts.home._login')
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div style="background-image: url('{{ url('/images/body_bg.png') }}'); background-repeat: repeat;">
        <div class="p-1 shadow bg-white" style="background-color: white">
            <div class="container">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}"><strong>Inicio</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><strong>Recuperar contraseña</strong></a>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row ml-0 mr-0">
                <div class="col col-lg-8 shadow-lg"
                    style="background-color: #c6481d; border-bottom: 5px solid white; border-right: 5px solid white; border-left: 5px solid white; border-top: 5px solid white;">
                    <div class="container px-md-5" style="background-color: #c6481d;color:white">
                        <br>
                        <div class="d-flex justify-content-center">
                            <h1><strong>¿Olvidaste tu contraseña?</strong></h1>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <div class="card">
                                <div class="card-body" style="background-color: #c6481d45; color: black;">
                                    <p>Ingrese su nombre de usuario y su dirección de correo electrónico a continuación
                                        y le
                                        enviaremos un enlace por correo electrónico para cambiar su contraseña.
                                        <strong>¡No hagas esto
                                            si alguien te pide que lo hagas!
                                        </strong>
                                    </p>
                                    <div class="d-flex justify-content-center">
                                        <!-- SVG images-->
                                        <img src="{{ url('/images/recoverPasswordSVG/rastaPunchDoi.svg') }}"
                                            height="210" , width="185">
                                        <img src="{{ url('/images/recoverPasswordSVG/boomerPunchRec.svg') }}"
                                            height="210" , width="195">
                                    </div>
                                    <div id="succesSendEmail" class="alert alert-success" role="alert"></div>
                                    <form id="recuperarContraseña">
                                        @csrf
                                        <div class="form-group">
                                            <h4><strong style="color: #348fdb;">Nombre de usuario:</strong></h4>
                                            <span id="nombreRecoverError" style="color:red" class="help-block"></span>
                                            <input name="nombreRecover" type="text" class="form-control"
                                                placeholder="Usuario" required>
                                        </div>
                                        <div class="form-group">
                                            <h4><strong style="color: #348fdb;">Correo electrónico:</strong></h4>
                                            <span id="emailRecoverError" style="color:red" class="help-block"></span>
                                            <input name="emailRecover" type="email" class="form-control"
                                                aria-describedby="emailHelp" placeholder="Escribe tu email" required>
                                        </div>

                                        <button type="submit"
                                            class="btn btn-primary btn-block"><strong>Recuperar</strong></button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center align-items-end">
                        @include('canvas._alienRecuperarPassword')
                    </div>
                </div>
                <div class="col-md-auto"></div>
                <div class="col p-0" id="barraDerecha">
                    @php
                        $tag = 'recoverPassword';
                    @endphp
                    @include('layouts.home._barraDerecha', ['tag' => $tag])
                </div>
            </div>
        </div>
        <br>
        @include('components._footerSocialNetwork')
    </div>
    <script>
        $("#succesSendEmail").fadeOut();
        $(document).ready(function() {
            $("#recuperarContraseña").on('submit',function(event) {
                event.preventDefault();
                $("#nombreRecoverError").fadeOut();
                $("#emailRecoverError").fadeOut();

                $.ajax({
                    url: "{{ route('send.new.password') }}",
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data.content == "error") {
                            $("#nombreRecoverError").text("Los datos no son correctos.")
                                .fadeIn();
                        } else {
                            $("#recuperarContraseña")[0].reset();
                            $("#succesSendEmail").text(data.content);
                            $("#succesSendEmail").fadeIn();
                        }
                    },
                    error: function(error) {
                        if (error.responseJSON.errors.nombreRecover) {
                            $("#nombreRecoverError").text(error.responseJSON.errors
                                    .nombreRecover)
                                .fadeIn();
                        }
                        if (error.responseJSON.errors.emailRecover) {
                            $("#emailRecoverError").text(error.responseJSON.errors
                                    .emailRecover)
                                .fadeIn();
                        }
                    }
                })
            })
        });

    </script>
</body>

</html>
