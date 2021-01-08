<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <script src="{{ url('/js/main.js') }}"></script>
    <title>Yoco: {{ $usuario->nombre }}</title>
    <script src="https://kit.fontawesome.com/b6add834b6.js" crossorigin="anonymous"></script>
    {{-- JS Config --}}
    <script type="text/javascript">
        @include('partials.viewconfig.head_scripts')
        @yield('head_script')
    </script>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
</head>

<body>
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v9.0&appId=235362160321908&autoLogAppEvents=1"
        nonce="ECJ4KVc4"></script>
    <div id="header">
        @yield('header')
    </div>
    <div id="app">
        <div style="background-image: url('{{ url('/images/body_bg.png') }}'); background-repeat: repeat;">
            @include('components._perfil-friend-navBar')
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
