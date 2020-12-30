<div class="row ml-0 mr-0">
    <div class="col-lg-8 shadow-lg"
        style="border-bottom: 5px solid white;background-color: #c6481d; border-right: 5px solid white; border-left: 5px solid white; border-top: 5px solid white;">
        <div class="container px-md-5" style="background-color: #c6481d;color:white">
            <br>
            <div class="d-flex justify-content-center">
                <h1><strong>Eventos & Concursos</strong></h1>
            </div>

            <br>
            <div class="row">
                <div class="col-8">
                    <div class="row">
                        <div class="col">
                            <svg width="20px" height="20px" viewBox="0 0 20 20" class="bi bi-bootstrap-fill"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.5355339,10.7071068 L9,14.2426407 L7.58578644,12.8284271 L10.4142136,10 L7.58578644,7.17157288 L9,5.75735931 L13.2426407,10 L12.5355339,10.7071068 L12.5355339,10.7071068 Z M10,-5.68434189e-14 C4.4771525,-5.68434189e-14 -5.68434189e-14,4.4771525 -5.68434189e-14,10 C-5.68434189e-14,15.5228475 4.4771525,20 10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,-5.32907052e-14 10,-5.68434189e-14 L10,-5.68434189e-14 Z M2,10 C2,14.418278 5.581722,18 10,18 C14.418278,18 18,14.418278 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 L2,10 Z" />
                            </svg>
                        </div>
                        <div class="col-10">
                            <h4>
                                <strong>
                                    Participa en los eventos y concursos de Yocomania y gana: creditos, objetos,
                                    membresia y mucho mas.<br>
                                    Recuerda que los eventos semanales duran 3 días.<br>
                                    No te los pierdas !!!
                                </strong>
                            </h4>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col align-self-end">
                    <!-- canvas image -->
                    <img src="{{ url('/images/homeSVG/nerdEventos.svg') }}"
                    height="160",
                    width="100">
                </div>
            </div>
            <hr style="border-top: 1px dashed white">
            <br>
            @if (count($eventos) <= 0)
                <div class="p-1 border rounded shadow-lg" style="background-color: #3490dc;">
                    <div class="d-flex justify-content-center">
                        <h3><strong>Próximamente...</strong></h3>
                    </div>
                    <div class="container">
                        <h5>No hay eventos disponibles por ahora. Estate atento a las noticias de Yocomania para no
                            perder ningun evento.</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <!-- canvas keko hablar-->
                    </div>
                </div>
                <br><br><br>
            @else
                <!-- foreach de eventos-->
                @foreach ($eventos as $evento)
                    <div class="card">
                        <div class="card-header" style="background-color: #af3911db;">
                            <img src="{{ url('/images/noticiaImg.png') }}" alt="noticia" />
                            <span style="color:#ffff00;"><strong>{!! $evento->created_at !!}</strong></span>
                        </div>
                        <div class="card-body" style="background-color: #c6481dc2;">
                            <h4 class="card-title"><strong>{!! $evento->titulo !!}</strong></h4>
                            <p class="card-text">{!! nl2br(e($evento->descripcion)) !!}</p>
                            @if ($evento->link != "")

                                <div class="rounded"
                                    style="background-image: url('{{ url('' . $evento->link . '') }}'); height:340px; width: 100%;background-repeat: no-repeat;background-size: 100% 100%">
                                </div>

                            @endif
                            <br>
                            <p class="card-text" style="color:#ffff00;">Empieza: {!! nl2br(e($evento->fecha)) !!} España
                                GMT</p>
                        </div>
                    </div>
                    <hr style="border-top: 1px dashed white">
                    <br>
                @endforeach
            @endif
            <div class="d-flex justify-content-center">
                {{ $eventos->links('pagination::bootstrap-4') }}
            </div>

            <hr style="border-top: 1px dashed white">
            <div class="d-flex justify-content-center">
                <h1><strong>Yocomania @Live</strong></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-8">
                    <div class="row">
                        <div class="col">
                            <svg width="20px" height="20px" viewBox="0 0 20 20" class="bi bi-bootstrap-fill"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.5355339,10.7071068 L9,14.2426407 L7.58578644,12.8284271 L10.4142136,10 L7.58578644,7.17157288 L9,5.75735931 L13.2426407,10 L12.5355339,10.7071068 L12.5355339,10.7071068 Z M10,-5.68434189e-14 C4.4771525,-5.68434189e-14 -5.68434189e-14,4.4771525 -5.68434189e-14,10 C-5.68434189e-14,15.5228475 4.4771525,20 10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,-5.32907052e-14 10,-5.68434189e-14 L10,-5.68434189e-14 Z M2,10 C2,14.418278 5.581722,18 10,18 C14.418278,18 18,14.418278 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 L2,10 Z" />
                            </svg>
                        </div>
                        <div class="col-10">
                            <h4>
                                <strong>
                                    Creas videos de Yocomania para YouTube?<br>
                                    Compartelos y saldran en esta secion!<br>
                                    Te apoyamos!
                                </strong>
                            </h4>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col align-self-end">
                    <!-- canvas image -->
                    <img src="{{ url('/images/homeSVG/rastaEventos.svg') }}"
                    height="160",
                    width="125">
                </div>
            </div>
            <div class="row">
                @foreach ($videosEvento as $video)
                    <div class="col-md-6 col-lg-4 p-2">
                        <div class="embed-responsive embed-responsive-4by3 shadow-lg rounded">
                            <iframe class="embed-responsive-item" src="{{ $video->link }}" allowfullscreen></iframe>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $videosEvento->links('pagination::bootstrap-4') }}
            </div>
            <br>
            <br> <br>
            <br> <br>
            <br> <br>
            <br> <br>
        </div>
    </div>
    <div class="col-md-auto"></div>
    <div class="col p-0" id="barraDerecha">
        @include('layouts.home._barraDerecha')
    </div>
</div>
