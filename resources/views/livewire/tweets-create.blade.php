<div>
    <br>
    <div class="shadow p-3 ml-0 mr-0 rounded">
        <div class="d-flex justify-content-center">
            <h3 style="color: #3490dc" ;><strong>Yoco<i class="fab fa-twitter"></i>Tweet</strong></h3>
        </div>
        <form wire:submit.prevent="publicar">
            <div class="row">
                <div class="col col-lg-2">
                    @include('components.Avatares._dinamicAvatar', ['usuario' =>
                    getUsuario(auth()->user()->id),
                    'height' =>
                    '100px', 'width' =>
                    '100px', 'route' => '/images/avataresSVG/'])
                </div>
                <div class="col-md-auto p-0"></div>
                <div class="col p-0 mt-2 mr-2">
                    <textarea wire:model="comentario" id="tweetText" class="form-control" rows="4"
                        placeholder="¿Qué está pasando?"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-1">
                <button id="publicTweet" type="submit" class="btn btn-primary"><strong>Publicar <i
                            class="fab fa-twitter"></i>Tweet</strong></button>
            </div>
        </form>
    </div>
    <br><br>
    @foreach ($tweetsYocomania as $tweet)
        <div class="border shadow-sm p-3 ml-0 mr-0 rounded">
            <div class="row">
                <div class="col col-lg-2">
                    <div class="mt-2">
                        @include('components.Avatares._dinamicAvatar', ['usuario' =>
                        getUsuario($tweet->usuario_id),
                        'height' =>
                        '100px', 'width' =>
                        '100px', 'route' => '/images/avataresSVG/'])
                    </div>
                </div>
                <div class="col-md-auto p-0"></div>
                <div class="col p-0 mt-2 mr-2">
                    @if ($tweet->usuario_id == auth()->user()->id)
                        <h5 style="color: #dc7e05;">
                            <strong>{{ getUserName($tweet->usuario_id) }}</strong>
                        </h5>
                    @else
                        <h5 style="color: #3490dc;">
                            <strong>{{ getUserName($tweet->usuario_id) }}</strong>
                        </h5>
                    @endif

                    Fecha población: {{ $tweet->created_at }}
                    <div class=" border rounded">
                        <div class="p-3">
                            {!! nl2br(e($tweet->tweet)) !!}
                        </div>
                    </div>
                    <strong style="color: #3490dc;">Likes: {{ $tweet->likes }}</strong>
                </div>
            </div>
            @if ($tweet->usuario_id == auth()->user()->id)
                <div class="d-flex justify-content-center mt-1">
                    <button wire:click="eliminar({{ $tweet->id }})" class="btn btn-danger"><strong>Eliminar
                            <i class="fab fa-twitter"></i>Tweet</strong></button>
                </div>
            @endif
        </div>
        <br>
    @endforeach
    <script>
        setInterval(fresh, 10000);

        function fresh() {
            Livewire.emit('render')
        }

    </script>
</div>
