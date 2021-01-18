@extends('layouts.plantilla')

@section('header')
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
@endsection

@section('content')
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row ml-0 mr-0">
                <div class="col col-lg-8 shadow-lg"
                    style="background-color: #c6481d; border-bottom: 5px solid white; border-right: 5px solid white; border-left: 5px solid white; border-top: 5px solid white;">
                    @include('components._home-news')
                </div>
                <div class="col-md-auto"></div>
                <div class="col p-0" id="barraDerecha">
                    @php 
                      $tag = "home";
                    @endphp
                    @include('layouts.home._barraDerecha', ['tag' => $tag ])
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-evento" role="tabpanel" aria-labelledby="pills-evento-tab">
            @include('components._home-eventos')
        </div>
        <div class="tab-pane fade" id="pills-screenshots" role="tabpanel" aria-labelledby="pills-screenshots-tab">
            @include('components._home-screenshots')
        </div>
        <div class="tab-pane fade" id="pills-fanart" role="tabpanel" aria-labelledby="pills-fanart-tab">
            @include('components._home-fanart')
        </div>
        <div class="tab-pane fade" id="pills-seguridad" role="tabpanel" aria-labelledby="pills-seguridad-tab">
            @include('components._home-seguridad')
        </div>
        <div class="tab-pane fade" id="pills-padres" role="tabpanel" aria-labelledby="pills-padres-tab">
            @include('components._home-padres')
        </div>
        <div class="tab-pane fade" id="pills-creditos" role="tabpanel" aria-labelledby="pills-creditos-tab">
            @include('components._home-creditos')
        </div>
        <div class="tab-pane fade" id="pills-vip" role="tabpanel" aria-labelledby="pills-vip-tab">
            @include('components._home-vip')
        </div>
        <div class="tab-pane fade" id="pills-contacto" role="tabpanel" aria-labelledby="pills-contacto-tab">
            @include('components._home-contacto')
        </div>
    </div>
@endsection
