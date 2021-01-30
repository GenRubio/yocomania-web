<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:url" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Yocomania Chat & Play" />
    <meta property="og:description"
        content="Chatea y juega en la comunidad virtual de Yocomania. Crea tu isla, decórala con objetos e invita a tus amigos a visitarla, Participa en los concursos de ..." />
    <meta property="og:image" content="" />
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/eventoButtons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/screenshots.css') }}">
    <script src="{{ url('/js/main.js') }}"></script>
    {{-- JS Config --}}
    <livewire:styles />
    <livewire:scripts />
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <script type="text/javascript">
        @include('partials.viewconfig.head_scripts')
        @yield('head_script')

    </script>
    <title>Yocomania</title>
</head>

<body>
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <div id="header">
        @yield('header')
    </div>
    <div id="app" class="plantilla-section-js">
        <div style="background-image: url('{{ url('/images/body_bg.png') }}'); background-repeat: repeat;">
            @include('components._home-navBar')
            <br>
            <div class="container">
                @yield('content')
            </div>
            <br>
            @include('components._footerSocialNetwork')
        </div>
    </div>
</body>

</html>
