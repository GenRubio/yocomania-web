@extends('layouts.plantilla-dashboard')

@section('header')
    <div
        style="background-image: url('{{ url('/images/homeBaner2.png') }}');                                                                                                                              background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div style="height: 266px;"></div>
        </div>
    </div>
@endsection

@section('content')
    <style>
        tbody {
            display: block;
            height: 1005px;
            overflow: auto;
        }

        thead,
        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

    </style>
    <div class="row">
        <div class="col col-lg-3">
            <div class="p-2 rounded shadow-lg" style="background-color: white">
                <div class="d-flex justify-content-center">
                    <h3><strong style="color: #dc7e05;">Mini Juegos</strong></h3>
                </div>
                <a href="{{ route('ranking.ring') }}" style="text-decoration: none;">
                    <div class="border shadow-sm rounded p-2 mb-1"
                        style="{{ Request::is('ranking/ring') ? 'background-color: #3490dc; color: white;' : '' }}">
                        <div class="d-flex">
                            <div>
                                <img src="{{ url('/images/levelsSvg/144.svg') }}" height="30" , width="30">
                            </div>
                            <div class="ml-2">
                                <strong style="font-size: 20px;">Ring</strong>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('ranking.sendero') }}" style="text-decoration: none">
                    <div class="border shadow-sm rounded p-2 mb-1"
                        style="{{ Request::is('ranking/sendero-oculto') ? 'background-color: #3490dc; color: white;' : '' }}">
                        <div class="d-flex">
                            <div>
                                <img src="{{ url('/images/levelsSvg/liana.png') }}" height="30" , width="32">
                            </div>
                            <div class="ml-2">
                                <strong style="font-size: 20px;">Sendero Oculto</strong>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('ranking.cocos-locos') }}" style="text-decoration: none">
                    <div class="border shadow-sm rounded p-2 mb-1"
                        style="{{ Request::is('ranking/cocos-locos') ? 'background-color: #3490dc; color: white;' : '' }}">
                        <div class="d-flex">
                            <div>
                                <img src="{{ url('/images/levelsSvg/2.svg') }}" height="30" , width="32">
                            </div>
                            <div class="ml-2">
                                <strong style="font-size: 20px;">Cocos Locos</strong>
                            </div>
                        </div>
                     
                    </div>
                </a>
                <a href="{{ route('ranking.camino-ninja') }}" style="text-decoration: none">
                    <div class="border shadow-sm rounded p-2 mb-1"
                        style="{{ Request::is('ranking/camino-ninja') ? 'background-color: #3490dc; color: white;' : '' }}">
                        <div class="d-flex">
                            <div>
                                <img src="{{ url('/images/levelsSvg/500.svg') }}" height="30" , width="32">
                            </div>
                            <div class="ml-2">
                                <strong style="font-size: 20px;">Camino Ninja</strong>
                            </div>
                        </div>
                      
                    </div>
                </a>

            </div>
            <br>
            <div class="p-2 rounded shadow-lg " style="background-color: white">
                <div class="d-flex justify-content-center">
                    <h3><strong style="color: #dc7e05;">Estadísticas</strong></h3>
                </div>
                <a href="{{ route('ranking.besos') }}" style="text-decoration: none;">
                    <div class="border shadow-sm rounded p-2 mb-1"
                        style="{{ Request::is('ranking/besos') ? 'background-color: #3490dc; color: white;' : '' }}">
                        <div class="d-flex">
                            <div>
                                <img src="{{ url('/images/levelsSvg/204.svg') }}" height="30" , width="32">
                            </div>
                            <div class="ml-2">
                                <strong style="font-size: 20px;">Besos</strong>
                            </div>
                        </div>
                      
                    </div>
                </a>
                <a href="{{ route('ranking.bebidas') }}" style="text-decoration: none">
                    <div class="border shadow-sm rounded p-2 mb-1"
                        style="{{ Request::is('ranking/bebidas') ? 'background-color: #3490dc; color: white;' : '' }}">
                        <div class="d-flex">
                            <div>
                                <img src="{{ url('/images/levelsSvg/196.svg') }}" height="30" , width="32">
                            </div>
                            <div class="ml-2">
                                <strong style="font-size: 20px;">Bebidas</strong>
                            </div>
                        </div>
                       
                    </div>
                </a>
                <a href="{{ route('ranking.flores') }}" style="text-decoration: none">
                    <div class="border shadow-sm rounded p-2 mb-1"
                        style="{{ Request::is('ranking/flores') ? 'background-color: #3490dc; color: white;' : '' }}">
                        <div class="d-flex">
                            <div>
                                <img src="{{ url('/images/levelsSvg/188.svg') }}" height="30" , width="32">
                            </div>
                            <div class="ml-2">
                                <strong style="font-size: 20px;">Flores</strong>
                            </div>
                        </div>
                       
                    </div>
                </a>
                <a href="{{ route('ranking.uppercuts') }}" style="text-decoration: none">
                    <div class="border shadow-sm rounded p-2 mb-1"
                        style="{{ Request::is('ranking/uppercuts') ? 'background-color: #3490dc; color: white;' : '' }}">
                        <div class="d-flex">
                            <div>
                                <img src="{{ url('/images/levelsSvg/170.svg') }}" height="30" , width="32">
                            </div>
                            <div class="ml-2">
                                <strong style="font-size: 20px;">Uppercuts</strong>
                            </div>
                        </div>
                        
                    </div>
                </a>
                <a href="{{ route('ranking.cocos') }}" style="text-decoration: none">
                    <div class="border shadow-sm rounded p-2 mb-1"
                        style="{{ Request::is('ranking/cocos') ? 'background-color: #3490dc; color: white;' : '' }}">
                        <div class="d-flex">
                            <div>
                                <img src="{{ url('/images/levelsSvg/27.svg') }}" height="30" , width="32">
                            </div>
                            <div class="ml-2">
                                <strong style="font-size: 20px;">Cocos</strong>
                            </div>
                        </div>
                        
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-auto"></div>
        <div class="col border shadow-lg rounded" style="background-color: white">
            <div class="container p-3">
                @isset($besos)
                    @include('components.dashboard.rankings.besos')
                @endisset
                @isset($bebidas)
                    @include('components.dashboard.rankings.bebidas')
                @endisset
                @isset($flores)
                    @include('components.dashboard.rankings.flores')
                @endisset
                @isset($uppercuts)
                    @include('components.dashboard.rankings.uppercuts')
                @endisset
                @isset($cocos)
                    @include('components.dashboard.rankings.cocos')
                @endisset
                @isset($camino_ninja)
                    @include('components.dashboard.rankings.camino_ninja')
                @endisset
                @isset($ring)
                    @include('components.dashboard.rankings.ring')
                @endisset
                @isset($sendero_oculto)
                    @include('components.dashboard.rankings.sendero_oculto')
                @endisset
                @isset($cocos_locos)
                    @include('components.dashboard.rankings.cocos_locos')
                @endisset
            </div>
        </div>
    </div>
@endsection
