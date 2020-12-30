@foreach ($eventos as $evento)
    <div class="card">
        <div class="card-header">
            <strong>{{ $evento->nombre }}</strong>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $evento->titulo }}</h5>
            <p class="card-text"> {!! nl2br(e($evento->descripcion)) !!}</p>
            @if ($evento->link != '')
                <div class="rounded"
                    style="background-image: url('{{ url('' . $evento->link . '') }}'); height:340px; width: 70%;background-repeat: no-repeat;background-size: 100% 100%">
                </div>
                <br>
            @endif
            <br>
            <p class="card-text" style="color:red;">Empieza: {!! nl2br(e($evento->fecha)) !!} España
                GMT</p>
            <form id="eliminarEvento" method="POST" action="{{ route('eventos.delete') }}">
                @csrf
                <input type="hidden" name="eventoId" value="{{ $evento->id }}">
                <button type="submit" class="btn btn-danger">Eliminar Evento</button>
            </form>
        </div>
    </div>
    <br>
@endforeach
