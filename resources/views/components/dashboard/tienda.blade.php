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
    <div class="p-2 rounded shadow-lg" style="background-color: white">
        <div class="d-flex justify-content-center">
            <h1><strong style="color:#3490dc">Yocomania Shop</strong></h1>
        </div>
        <br>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-news-tab" data-toggle="tab" href="#nav-news" role="tab"
                    aria-controls="nav-news" aria-selected="true"><strong>Nuevos Objetos</strong></a>
                <a class="nav-item nav-link" id="nav-fichas-tab" data-toggle="tab" href="#nav-fichas" role="tab"
                    aria-controls="nav-fichas" aria-selected="false"><strong>Tienda Fichas</strong></a>
                <a class="nav-item nav-link" id="nav-mercado-tab" data-toggle="tab" href="#nav-mercado" role="tab"
                    aria-controls="nav-mercado" aria-selected="false"><strong>Mercado</strong></a>
                <a class="nav-item nav-link" id="nav-subasta-tab" data-toggle="tab" href="#nav-subasta" role="tab"
                    aria-controls="nav-subasta" aria-selected="false"><strong>Subastas</strong></a>
                <a class="nav-item nav-link" id="nav-limitado-tab" data-toggle="tab" href="#nav-limitado" role="tab"
                    aria-controls="nav-limitado" aria-selected="false"><strong>Tienda Objetos Limitados</strong></a>
                <a class="nav-item nav-link" id="nav-creditos-tab" data-toggle="tab" href="#nav-creditos" role="tab"
                    aria-controls="nav-creditos" aria-selected="false"><strong style="color: #dc7e05">Créditos</strong></a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-news" role="tabpanel" aria-labelledby="nav-news-tab">
                ...
                <div style="min-height: 300px;
                background-repeat: no-repeat;
                background-position: center;
                background-image: url('{{ url('/images/dashboarSVG/banner10.png') }}');"></div>
            </div>
            <div class="tab-pane fade" id="nav-fichas" role="tabpanel" aria-labelledby="nav-fichas-tab">
                <div class="obtener-fichas-catalago"></div>
                 <div style="min-height: 300px;
                background-repeat: no-repeat;
                background-position: center;
                background-image: url('{{ url('/images/dashboarSVG/banner10.png') }}');"></div>
            </div>
            <div class="tab-pane fade" id="nav-mercado" role="tabpanel" aria-labelledby="nav-mercado-tab">
                ...
                 <div style="min-height: 300px;
                background-repeat: no-repeat;
                background-position: center;
                background-image: url('{{ url('/images/dashboarSVG/banner10.png') }}');"></div>
            </div>
            <div class="tab-pane fade" id="nav-subasta" role="tabpanel" aria-labelledby="nav-subasta-tab">
                ...
                 <div style="min-height: 300px;
                background-repeat: no-repeat;
                background-position: center;
                background-image: url('{{ url('/images/dashboarSVG/banner10.png') }}');"></div>
            </div>
            <div class="tab-pane fade" id="nav-limitado" role="tabpanel" aria-labelledby="nav-limitado-tab">
                ...
                 <div style="min-height: 300px;
                background-repeat: no-repeat;
                background-position: center;
                background-image: url('{{ url('/images/dashboarSVG/banner10.png') }}');"></div>
            </div>
            <div class="tab-pane fade" id="nav-creditos" role="tabpanel" aria-labelledby="nav-creditos-tab">
                <livewire:tienda-creditos />
                 <div style="min-height: 300px;
                background-repeat: no-repeat;
                background-position: center;
                background-image: url('{{ url('/images/dashboarSVG/banner10.png') }}');"></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            cargar_catalago_fichas();

            function cargar_catalago_fichas(){
                $.ajax({
                    url: "{{ route('show.tienda.fichas') }}",
                    method: "GET",
                    success:function(data){
                        $('.obtener-fichas-catalago').html(data.content);
                    }
                });
            }
        });
    </script>
@endsection
