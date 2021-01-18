<div>
    <br>
    @if (count($comunicados) == 0)
        <div class="border shadow-sm p-3 ml-0 mr-0 rounded">
            <div class="d-flex justify-content-center">
                <h3 style="color: #3490dc" ;><strong>Yoco<i class="fab fa-twitter"></i>Tweet</strong></h3>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <h6><strong>No hay comunicados.</strong></h6>
            </div>
        </div>
    @endif
    @foreach ($comunicados as $tweet)
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
                    <h5 style="color: #3490dc;"><strong>{{ getUserName(auth()->user()->id) }}</strong></h5>
                    Fecha población: {{ $tweet->created_at }}
                    <div class=" border rounded">
                        <div class="p-3">
                            {!! nl2br(e($tweet->tweet)) !!}
                        </div>
                    </div>
                    <strong style="color: #3490dc;">Likes: {{ $tweet->likes }}</strong>
                </div>
            </div>
        </div>
        <br>
    @endforeach
</div>
