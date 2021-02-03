@if (count($mensajes) == 0)
    <div class="p-2 border rounded shadow mb-3">
        <div class="d-flex justify-content-center">
            <strong>No hay mensajes pendientes</strong>
        </div>
    </div>
@endif
@foreach ($mensajes as $mensaje)
    <div class="p-2 border rounded shadow mb-3">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="align-self-center">
                <div class="d-flex">
                    <div>
                        <img src="{{ url('/images/support/fichaGod.png') }}" height="50" , width="43">
                    </div>
                    <div class="align-self-center">
                        <small class="form-text text-muted ml-2">{{ $mensaje->fecha }}</small>
                        <strong class="ml-2" style="font-size: 20px; color: #3490dc;">YocoTeams:</strong> 
                        <span><strong style="font-size: 20px; color:black;">{{ $mensaje->subject }}</strong></span>
                      
                    </div>
                </div>
               
            </div>
            <div class="align-self-center">
                <button class="btn btn-primary" data-toggle="modal"
                    data-target="#supportMessage{{ $mensaje->id }}"><strong>Ver</strong></button>
                <div class="modal fade" id="supportMessage{{ $mensaje->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="supportMessage{{ $mensaje->id }}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="supportMessage{{ $mensaje->id }}Label">
                                    <strong>{{ $mensaje->subject }}</strong>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! nl2br(e($mensaje->contenido))  !!}
                                <br>
                                {{ $mensaje->fecha }}
                            </div>
                        </div>
                    </div>
                </div>
                <button id="{{ $mensaje->id }}" _token="{{ csrf_token() }}" type="submit"
                    class="btn btn-danger deleteSupport">
                    <strong>Eliminar</strong>
                </button>
            </div>
        </div>
    </div>
@endforeach
