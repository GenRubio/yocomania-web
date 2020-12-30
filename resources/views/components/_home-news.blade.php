<div class="container px-md-5" style="background-color: #c6481d;color:white">
    <br>
    <div class="d-flex justify-content-center">
        <h1><strong>Yocomania: Chat and Play!</strong></h1>
    </div>
    <div class="d-flex justify-content-center">
        <h2><strong>Descubre un nuevo mundo</strong></h2>
    </div>
    <br>
    @foreach ($noticias as $noticia)
        <div class="card">
            <div class="card-header" style="background-color: #af3911db;">
                <img src="{{ url('/images/noticiaImg.png') }}" alt="noticia" />
                <span style="color:#ffff00;"><strong>{!! $noticia->fecha !!}</strong></span>
            </div>
            <div class="card-body" style="background-color: #c6481dc2;">
                <h4 class="card-title"><strong>{!! $noticia->titulo !!}</strong></h4>
                <p class="card-text">{!! nl2br(e($noticia->contenido)) !!}</p>
            </div>
            @if ($noticia->image != '')

                <div class="rounded"
                    style="background-image: url('{{ url('' . $noticia->image . '') }}'); height:340px; width: 100%;background-repeat: no-repeat;background-size: 100% 100%">
                </div>

            @endif
        </div>
        <hr style="border-top: 1px dashed white">
        <br>
    @endforeach
</div>
<br>
<div class="d-flex justify-content-center">
    {{ $noticias->links('pagination::bootstrap-4') }}
</div>
