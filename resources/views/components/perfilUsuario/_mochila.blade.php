<div class="container shadow-lg rounded" style="background-color: white;">
    <div class="p-1"></div>
    <div class="row ml-1 mr-1 border p-2 rounded mb-1" style="background-color: aliceblue;">
        <div class="col text-center">
            <h4><strong style="color: #3490dc;">Mochila</strong></h4>
        </div>
    </div>
    <p class="p-1">
        Presiona sobre un objeto para subastarlo, venderlo o ver su información.<br>
        Puedes cancelar la venta o subasta cuando quieras.
    </p>
    <div class="d-flex justify-content-center">
        <a type="button" data-toggle="modal" data-target="#informacionVentaObjeto" style="text-decoration: none">
            <strong style="color: #3490dc">Ver más información</strong>
        </a>
    </div>
    <div class="modal fade" id="informacionVentaObjeto" tabindex="-1" role="dialog"
        aria-labelledby="informacionVentaObjetoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="informacionVentaObjetoLabel">Más información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
<br>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-mis-objetos-tab" data-toggle="tab" href="#nav-mis-objetos"
            role="tab" aria-controls="nav-mis-objetos" aria-selected="true"><strong>Mis Objetos</strong></a>
        <a class="nav-item nav-link" id="nav-mis-objetos-venta-tab" data-toggle="tab" href="#nav-mis-objetos-venta"
            role="tab" aria-controls="nav-mis-objetos-venta" aria-selected="false"><strong>Objetos en venta</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="p-1"></div>
    <div class="tab-pane fade show active" id="nav-mis-objetos" role="tabpanel" aria-labelledby="nav-mis-objetos-tab">
        <div class="container shadow-lg rounded" style="background-color: white;">
            <div class="p-1"></div>
            <div class="row ml-1 mr-1 border p-1 rounded mb-1" style="background-color: aliceblue;">
                <div class="col text-center">
                    <h4><strong style="color: #3490dc;">{{ count($total) }} objetos</strong></h4>
                </div>
            </div>
            <div class="p-1"></div>
            <div class="row text-center justify-content-center">
                @foreach ($objetos as $objeto)
                    <a class="col-sm-6 col-md-4 col-lg-3 border rounded shadow m-3 btn" data-toggle="modal"
                        data-target="#objeto{{ $objeto->objeto_id }}"
                        style="min-height: 170px; max-height: 170px;position: relative;">
                        @if ($objeto->img == 0)
                            <img style="max-height: 100%;
                            max-width: 100%;
                            width: auto;
                            height: auto;
                            position: absolute;
                            top: 0;
                            bottom: 0;
                            left: 0;
                            right: 0;
                            margin: auto;" src="{{ url('/images/objetos/previewObject.svg') }}">
                        @else
                            <img style="max-height: 100%;
                            max-width: 100%;
                            width: auto;
                            height: auto;
                            position: absolute;
                            top: 0;
                            bottom: 0;
                            left: 0;
                            right: 0;
                            margin: auto;" src="{{ url('/images/objetos/' . $objeto->swf . '.png') }}">
                        @endif
                    </a>
                    <div class="modal fade" id="objeto{{ $objeto->objeto_id }}" tabindex="-1" role="dialog"
                        aria-labelledby="objeto{{ $objeto->objeto_id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title w-100 text-center" id="objeto{{ $objeto->objeto_id }}Label">
                                        <strong>{{ $objeto->titulo }}</strong>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="sessesObject{{ $objeto->objeto_id }}" class="alert alert-success"
                                        role="alert">
                                    </div>
                                    <span id="errorObject{{ $objeto->objeto_id }}" style="color:red"
                                        class="help-block"></span>
                                    <div class="text-left">
                                        <p>Descripción: {{ $objeto->descripcion }}</p>
                                        <p>Cantidad: <strong>{{ $objeto->cantidad }}</strong></p>
                                    </div>
                                    @if ($objeto->img == 0)
                                        <img class="mt-3" src="{{ url('/images/objetos/previewObject.svg') }}">
                                    @else
                                        <img class="mt-3" src="{{ url('/images/objetos/' . $objeto->swf . '.png') }}">
                                    @endif
                                    <div class="text-left">
                                        @if ($objeto->precio_oro > 0)
                                            <img src="{{ url('/images/perfil/monedasOro.png') }}" height="35" ,
                                                width="35">
                                            <span><strong>{{ $objeto->precio_oro }}</strong></span>
                                        @else
                                            <img src="{{ url('/images/perfil/monedasPlata.png') }}" height="35" ,
                                                width="35">
                                            <span><strong>{{ $objeto->precio_plata }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-1">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active"
                                                id="nav-vender{{ $objeto->objeto_id }}-tab" data-toggle="tab"
                                                href="#nav-vender{{ $objeto->objeto_id }}" role="tab"
                                                aria-controls="nav-vender{{ $objeto->objeto_id }}"
                                                aria-selected="true"><strong>Vender</strong></a>
                                            <a class="nav-item nav-link" id="nav-subastar{{ $objeto->objeto_id }}-tab"
                                                data-toggle="tab" href="#nav-subastar{{ $objeto->objeto_id }}"
                                                role="tab" aria-controls="nav-subastar{{ $objeto->objeto_id }}"
                                                aria-selected="false"><strong>Subastar</strong></a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-vender{{ $objeto->objeto_id }}"
                                            role="tabpanel" aria-labelledby="nav-vender{{ $objeto->objeto_id }}-tab">
                                            <form id="venderObjeto{{ $objeto->objeto_id }}" class="mt-2">
                                                @csrf
                                                <input type="hidden" name="compraId" value="{{ $objeto->id }}">
                                                <input type="hidden" name="objetoId" value="{{ $objeto->objeto_id }}">
                                                @if ($objeto->cantidad > 1)
                                                    <div class="form-row mb-2">
                                                        <div class="col">
                                                            <div class="text-center">
                                                                Cantidad
                                                            </div>
                                                            <input type="number" class="form-control form-control-sm"
                                                                value="1" min="1" max="{{ $objeto->cantidad }}">
                                                        </div>
                                                        <div class="col"></div>
                                                    </div>
                                                @endif
                                                <div class="form-row">
                                                    <div class="col">
                                                        <select name="creditos" id="inputState" class="form-control">
                                                            @if ($objeto->precio_oro > 0)
                                                                <option value="oro" selected>Créditos Oro</option>
                                                                <option value="plata">Créditos Plata</option>
                                                            @else
                                                                <option value="plata" selected>Créditos Plata</option>
                                                                <option value="oro">Créditos Oro</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        @if ($objeto->precio_oro > 0)
                                                            <input name="ventaOro" type="number" class="form-control"
                                                                value="{{ $objeto->precio_oro }}" max="99999">
                                                        @else
                                                            <input name="ventaOro" type="number" class="form-control"
                                                                value="{{ $objeto->precio_plata }}" max="99999">
                                                        @endif
                                                    </div>
                                                </div>
                                                <br>
                                                <button type="submit"
                                                    class="btn btn-primary btn-block mb-2"><strong>Vender</strong></button>
                                                @if (auth()->user()->admin == 1)
                                                    <p style="color: red;">SWF: {{ $objeto->swf }}</p>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="nav-subastar{{ $objeto->objeto_id }}"
                                            role="tabpanel" aria-labelledby="nav-subastar{{ $objeto->objeto_id }}-tab">
                                            ...</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("#sessesObject{{ $objeto->objeto_id }}").fadeOut();
                        $("#errorObject{{ $objeto->objeto_id }}").fadeOut();
                        $(document).ready(function() {
                            var updateListObjects = false;
                            $('#objeto{{ $objeto->objeto_id }}').on('hidden.bs.modal', function() {
                                if (updateListObjects == true) {
                                    obtener_Mochila();
                                    updateListObjects = false;
                                }
                            });
                            $("#venderObjeto{{ $objeto->objeto_id }}").on('submit', function(event) {
                                event.preventDefault();
                                $("#sessesObject{{ $objeto->objeto_id }}").fadeOut();
                                $("#errorObject{{ $objeto->objeto_id }}").fadeOut();

                                $.ajax({
                                    url: "{{ route('vender.objeto') }}",
                                    method: 'POST',
                                    data: new FormData(this),
                                    dataType: 'json',
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(data) {
                                        $("#sessesObject{{ $objeto->objeto_id }}").fadeIn();
                                        $("#sessesObject{{ $objeto->objeto_id }}").text(data
                                            .result);
                                        updateListObjects = true;
                                    },
                                    error: function(error) {
                                        if (error.responseJSON.errors.ventaOro) {
                                            $("#errorObject{{ $objeto->objeto_id }}").text(
                                                    error
                                                    .responseJSON.errors
                                                    .ventaOro)
                                                .fadeIn();
                                        }
                                    }
                                })
                            });
                            //Mochila Usuario
                            function obtener_Mochila() {
                                $.ajax({
                                    url: "{{ route('obtener.mochila') }}",
                                    method: "POST",
                                    data: {
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    success: function(data) {
                                        $('#obtenerMochilaUsuario').html(data.content);
                                    }
                                });
                            }
                        });

                    </script>
                @endforeach
            </div>
            <br>
            <div class="d-flex justify-content-center">
                {{ $objetos->links('pagination::bootstrap-4') }}
            </div>
            <br><br>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-mis-objetos-venta" role="tabpanel" aria-labelledby="nav-mis-objetos-venta-tab">
        <div class="container shadow-lg rounded" style="background-color: white;">
            <div class="p-1"></div>
            <div class="row ml-1 mr-1 border p-1 rounded mb-1" style="background-color: aliceblue;">
                <div class="col text-center">
                    <h4><strong style="color: #3490dc;">Mis objetos en venta</strong></h4>
                </div>

            </div>
            <div class="p-1"></div>
            <div id="cargarObjetosVenta"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        cargar_mis_ventas();

        function cargar_mis_ventas() {
            $.ajax({
                url: "{{ route('cargar.user.ventas') }}",
                method: 'GET',
                success: function(data) {
                    $('#cargarObjetosVenta').html(data.content);
                }
            })
        }
    });

</script>
