<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <link href="{{ url('/css/avatar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/eventoButtons.css') }}">
    <title>Yocomania</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
</head>

<body>
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
                        <a class="nav-link active" href="#"><strong>Descargar Yocomania</strong></a>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="shadow-lg ml-0 mr-0"
                style="background-color: #c6481d; border-bottom: 5px solid white; border-right: 5px solid white; border-left: 5px solid white; border-top: 5px solid white;">
                <div class="container px-md-5" style="background-color: #c6481d;color:white">
                    <br>
                    <div class="d-flex justify-content-center">
                        <h1><strong>Descarga Yocomania</strong></h1>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p>Escoge tu sistema operativo y descarga ya Yocomania!!! ¿A que estas esperando?</p>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col p-1">
                            <div class="card shadow">
                                <div class="card-header w-100 text-center" style="background-color: #af3911db">
                                    <h2 style="color: #3490dc"><strong style="color: gold">Windows</strong></h2>
                                </div>
                                <div class="card-body" style="background-color: #c6481dc2">

                                    <div class="d-flex justify-content-center">
                                        <a href="{{ url('/download/YocoSetup.exe') }}">
                                            <img src="{{ url('/images/download/windows-button.png') }}" , height="100px"
                                                , width="auto">
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto"></div>
                        <div class="col p-1">
                            <div class="card shadow">
                                <div class="card-header w-100 text-center" style="background-color: #af3911db">
                                    <h2 style="color: #3490dc"><strong style="color: gold">Mac OS</strong></h2>
                                </div>
                                <div class="card-body" style="background-color: #c6481dc2">
                                    <div class="d-flex justify-content-center">
                                        <a href="#">
                                            <img src="{{ url('/images/download/mac-download-button.png') }}" ,
                                                height="100px" , width="auto">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="p-2">
                            <img src="{{ url('/images/download/dj.svg') }}" , height="200px" , width="140px">
                        </div>
                        <div class="p-2">
                            <img src="{{ url('/images/download/mafi.svg') }}" , height="200px" , width="150px">
                        </div>
                    </div>
                    <br> <br> <br>
                </div>
            </div>
        </div>
        <br>
        @include('components._footerSocialNetwork')
    </div>
</body>

</html>
