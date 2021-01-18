<div>
    <br>
    @if (count($tweetsUsuario) == 0)
        <div class="border shadow-sm p-3 ml-0 mr-0 rounded">
            <div class="d-flex justify-content-center">
                <h3 style="color: #3490dc" ;><strong>Yoco<i class="fab fa-twitter"></i>Tweet</strong></h3>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <h6><strong>No tienes Tweets creados. ¿A qué esperas para publicar?</strong></h6>
            </div>
        </div>
    @endif
    @foreach ($tweetsUsuario as $tweet)
        <div class="border shadow-sm p-3 ml-0 mr-0 rounded">
            <div class="row">
                <div class="col col-lg-2">
                    <div class="mt-2">
                        @include('components.Avatares._dinamicAvatar', ['usuario' =>
                        getUsuario(auth()->user()->id),
                        'height' =>
                        '100px', 'width' =>
                        '100px', 'route' => '/images/avataresSVG/'])
                    </div>
                </div>
                <div class="col-md-auto p-0"></div>
                <div class="col p-0 mt-2 mr-2">
                    Fecha población: {{ $tweet->created_at }}
                    <div class=" border rounded">
                        <div class="p-3">
                            <h5 style="color: #3490dc;"><strong>Gen</strong></h5>
                            {!! nl2br(e($tweet->tweet)) !!}
                        </div>
                    </div>
                    <strong style="color: #3490dc;">Likes: {{ $tweet->likes }}</strong>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-1">
                <button wire:click="eliminar({{ $tweet->id }})" class="btn btn-danger"><strong>Eliminar <i
                            class="fab fa-twitter"></i>Tweet</strong></button>
            </div>
        </div>
        <br>
    @endforeach
</div>
