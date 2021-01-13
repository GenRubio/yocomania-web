<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <livewire:styles />
    <livewire:scripts />
    <title>Dashboard</title>
</head>

<body>
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg">
        <a class="navbar-brand" href="{{ route('home') }}"><strong style="color: #3490dc;">Yocomania</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <form action="{{ route('admin.logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                @csrf
                <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Cerrar Sesion</button>
            </form>
        </div>
    </nav>
    <br><br><br>
    <div class="container">
        <div class="p-2 border rounded shadow">
            <div class="row">
                <div class="col col-lg-3 border-right">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                            role="tab" aria-controls="v-pills-home" aria-selected="true"><strong>Home</strong></a>
                        <a class="nav-link" id="v-pills-noticias-tab" data-toggle="pill" href="#v-pills-noticias"
                            role="tab" aria-controls="v-pills-noticias"
                            aria-selected="false"><strong>Noticias</strong></a>
                        <a class="nav-link" id="v-pills-eventos-tab" data-toggle="pill" href="#v-pills-eventos"
                            role="tab" aria-controls="v-pills-eventos"
                            aria-selected="false"><strong>Eventos</strong></a>
                        <a class="nav-link" id="v-pills-screenshots-tab" data-toggle="pill" href="#v-pills-screenshots"
                            role="tab" aria-controls="v-pills-screenshots"
                            aria-selected="false"><strong>Screenshots</strong></a>
                        <a class="nav-link" id="v-pills-fanart-tab" data-toggle="pill" href="#v-pills-fanart" role="tab"
                            aria-controls="v-pills-fanart" aria-selected="false"><strong>Fanart</strong></a>
                        <a class="nav-link" id="v-pills-youtube-tab" data-toggle="pill" href="#v-pills-youtube"
                            role="tab" aria-controls="v-pills-youtube" aria-selected="false"><strong>Contenido
                                YouTube</strong></a>
                        <a class="nav-link" id="v-pills-contacto-tab" data-toggle="pill" href="#v-pills-contacto"
                            role="tab" aria-controls="v-pills-contacto" aria-selected="false"><strong>Contacto
                                Message</strong></a>
                        <a class="nav-link" id="v-pills-support-tab" data-toggle="pill" href="#v-pills-support"
                            role="tab" aria-controls="v-pills-support" aria-selected="false"><strong>Support
                                Message</strong></a>
                        <a class="nav-link" id="v-pills-tienda-creditos-tab" data-toggle="pill"
                            href="#v-pills-tienda-creditos" role="tab" aria-controls="v-pills-tienda-creditos"
                            aria-selected="false"><strong>Tienda Créditos</strong></a>
                    </div>
                </div>
                <div class="col">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="d-flex justify-content-center">
                                <h3><strong>Bienvenido a Dashboard {{ auth()->user()->nombre }}.</strong></h3>
                            </div>
                            <p><strong>Desde aqui puedes administrar la pagina de Yocomania</strong></p>
                            <p><strong><i></i></strong></p>
                        </div>
                        <div class="tab-pane fade" id="v-pills-noticias" role="tabpanel"
                            aria-labelledby="v-pills-noticias-tab">
                            <livewire:create-noticia/>
                        </div>
                        <div class="tab-pane fade" id="v-pills-eventos" role="tabpanel"
                            aria-labelledby="v-pills-eventos-tab">
                            @include('adminDashboard.eventos')
                        </div>
                        <div class="tab-pane fade" id="v-pills-screenshots" role="tabpanel"
                            aria-labelledby="v-pills-screenshots-tab">
                            @include('adminDashboard.screenshots')
                        </div>
                        <div class="tab-pane fade" id="v-pills-fanart" role="tabpanel"
                            aria-labelledby="v-pills-fanart-tab">
                            @include('adminDashboard.fanart')
                        </div>
                        <div class="tab-pane fade" id="v-pills-contacto" role="tabpanel"
                            aria-labelledby="v-pills-contacto-tab">
                            @include('adminDashboard.contacto')
                        </div>
                        <div class="tab-pane fade" id="v-pills-youtube" role="tabpanel"
                            aria-labelledby="v-pills-youtube-tab">
                            @include('adminDashboard.youtube')
                        </div>
                        <div class="tab-pane fade" id="v-pills-support" role="tabpanel"
                            aria-labelledby="v-pills-support-tab">
                            @include('adminDashboard.support')
                        </div>
                        <div class="tab-pane fade" id="v-pills-tienda-creditos" role="tabpanel"
                            aria-labelledby="v-pills-tienda-creditos-tab">
                            <livewire:crear-producto/>
                        </div>
                    </div>
                    <br><br><br><br>
                    <br><br><br><br>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
