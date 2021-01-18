<div class="d-flex justify-content-center">
    <h2><strong>Eventos</strong></h2>
</div>
<hr style="border-top: 1px dashed white">
@if (count($eventos) <= 0)
    <div class="p-1 border rounded shadow-lg" style="background-color: #38c172;">
        <div class="d-flex justify-content-center">
            <h3><strong>Próximamente...</strong></h3>
        </div>
    </div>
@else
    <!-- foreach de eventos-->
    @foreach ($eventos as $evento)
        <button type="button" class="animated-button1 border rounded shadow-lg" data-toggle="modal"
            data-target="#evento{{ $evento->id }}{{ $tag }}" style="background-color: #c6481d; width: 100%">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <strong>{{ $evento->nombre }}</strong><br /><b
                style="font-size: 15px; color:#fdff00;">{{ $evento->fecha }}</b>
        </button>
        <div class="modal fade" id="evento{{ $evento->id }}{{ $tag }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="color: black">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong style="color: #3490dc;">{{ $evento->titulo }}</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong>{!! nl2br(e($evento->descripcion)) !!}</strong>
                        <br><br>

                        @if ($evento->link != '')
                            <div class="rounded"
                                style="background-image: url('{{ url('' . $evento->link . '') }}'); height:250px; width: 100%;background-repeat: no-repeat;background-size: 100% 100%">
                            </div>
                            <br>
                        @endif
                        <strong style="color: #3490dc">Empieza: {{ $evento->fecha }}</strong>
                        <br>
                        Yocomania Team: No te lo pierdas !!!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <br> <br>
    @endforeach
@endif
<br>
