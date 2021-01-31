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
                        <a class="nav-link" href="{{ route('home') }}"><strong>@lang('Inicio')</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><strong>@lang('Registro')</strong></a>
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
                            <h1><strong>@lang('¿Aún no eres miembro?')</strong></h1>
                        </div>
                        <div class="d-flex justify-content-center">
                            <h3><strong>@lang('¡Crea ya tu personaje!')</strong></h3>
                        </div>
                        <div class="d-flex justify-content-center">
                            @include('canvas._DJ-guitarra')
                        </div>
                        <br>
                        @include('components._registro-form')
                    </div>
                </div>
                <div class="col-md-auto"></div>
                <div class="col p-0" id="barraDerecha">
                    @php
                    $tag = "registro";
                    @endphp
                    @include('layouts.home._barraDerecha', ['tag' => $tag])
                </div>
            </div>
        </div>
        <br>
        @include('components._footerSocialNetwork')
    </div>
</body>

</html>
