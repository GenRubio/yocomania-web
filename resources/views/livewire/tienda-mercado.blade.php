<div>
    <div class="container">
        <div class="p-3 ml-5 mr-5">
            <input wire:model.debounce.500ms="search" type="text" class="form-control" placeholder="Buscar objeto...">
        </div>
        <div class="d-flex justify-content-center">
            <div class="form-row">
                <div class="col">
                    <label>Precio minimo</label>
                    <input wire:model="priceMin" type="number" class="form-control form-control-sm" min="0" max="99999">
                </div>
                <div class="col">
                    <label>Precio maximo</label>
                    <input wire:model="priceMax" type="number" class="form-control form-control-sm" min="0" max="99999">
                </div>
                <div class="col">
                    <label>Categoria</label>
                    <select class="form-control form-control-sm">
                        <option>Todos</option>
                        <option>Items</option>
                        <option>Rares</option>
                        <option>Muy Rares</option>
                        <option>Casi Unicos</option>
                        <option>Unicos</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <p><strong style="color:silver">Total resultados: {{ count($objetos) }}</strong></p>
        </div>
    </div>
    <div class="row text-center justify-content-center">
        @foreach ($objetos as $objeto)
            @if ($objeto->img == 0)
                <a type="button" class="col-sm-6 col-md-4 col-lg-3 border rounded shadow m-3 p-0" style="height: 210px;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url('{{ url('/images/objetos/previewObject.svg') }}');
            text-decoration: none;" data-toggle="modal" data-target="#objeto{{ $objeto->id }}">
                    <div class="d-flex justify-content-end flex-column" style="width: 100%; height: 100%;">
                        <div style="background-color: #0000007a; height: 50px;">
                            <h4 class="mt-2"><strong style="color:whitesmoke">{{ $objeto->titulo }}</strong>
                                <h4>
                        </div>
                        <div class="rounded-bottom" style="background-color: #000000b8; height: 35px;">
                            @if ($objeto->oro != -1)
                                <h6 class="mt-2">
                                    <strong style="color: gold">
                                        {{ $objeto->oro }} Créditos Oro
                                    </strong>
                                </h6>
                            @else
                                <h6 class="mt-2">
                                    <strong style="color: silver">
                                        {{ $objeto->plata }} Créditos Plata
                                    </strong>
                                </h6>
                            @endif

                        </div>
                    </div>
                </a>
            @else
                <a type="button" class="col-sm-6 col-md-4 col-lg-3 border rounded shadow m-3 p-0" style="height: 210px;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url('{{ url('/images/objetos/' . $objeto->swf . '.png') }}');
            text-decoration: none;
            background-size: 200px;" data-toggle="modal" data-target="#objeto{{ $objeto->id }}">
                    <div class="d-flex justify-content-end flex-column" style="width: 100%; height: 100%;">
                        <div style="background-color: #0000007a; height: 50px;">
                            <h4 class="mt-2"><strong style="color:whitesmoke">{{ $objeto->titulo }}</strong>
                                <h4>
                        </div>
                        <div class="rounded-bottom" style="background-color: #000000b8; height: 35px;">
                            @if ($objeto->oro != -1)
                                <h6 class="mt-2">
                                    <strong style="color: gold">
                                        {{ $objeto->oro }} Créditos Oro
                                    </strong>
                                </h6>
                            @else
                                <h6 class="mt-2">
                                    <strong style="color: silver">
                                        {{ $objeto->plata }} Créditos Plata
                                    </strong>
                                </h6>
                            @endif

                        </div>
                    </div>
                </a>
            @endif
            <div class="modal fade" id="objeto{{ $objeto->id }}" tabindex="-1" role="dialog"
                aria-labelledby="objeto{{ $objeto->id }}Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title w-100 text-center" id="objeto{{ $objeto->id }}Label">
                                <strong>{{ $objeto->titulo }}</strong>
                            </h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if ($objeto->img == 0)
                                <img class="mt-3" src="{{ url('/images/objetos/previewObject.svg') }}">
                            @else
                                <img class="mt-3" src="{{ url('/images/objetos/' . $objeto->swf . '.png') }}">
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
