<div class="row text-center justify-content-center">
    @foreach ($objetos as $objeto)
        <div class="col-sm-6 col-md-4 col-lg-3 border rounded shadow m-3"
            style="min-height: 210px; max-height: 210px;position: relative;">
            @if ($objeto->img == 0)
                <img class="mb-1" style="max-height: 100%;
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
                <img class="mb-1" style="max-height: 100%;
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
            <div class="d-flex justify-content-between mt-1">
                <div>
                    @if ($objeto->oro > 0)
                        <img src="{{ url('/images/perfil/monedasOro.png') }}" height="35" , width="35">
                        <span><strong>{{ $objeto->oro }}</strong></span>
                    @else
                        <img src="{{ url('/images/perfil/monedasPlata.png') }}" height="35" , width="35">
                        <span><strong>{{ $objeto->plata }}</strong></span>
                    @endif
                </div>
                <div>
                    <button type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#cancelarVenta{{ $objeto->id }}">
                        <strong><i class="fas fa-times"></i></strong>
                    </button>
                    <div class="modal fade" id="cancelarVenta{{ $objeto->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="cancelarVenta{{ $objeto->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title w-100 text-center" id="cancelarVenta{{ $objeto->id }}Label">
                                        <strong>Cancelar venta {{ $objeto->titulo }}</strong>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="succesDeleteVenta{{ $objeto->id }}" class="alert alert-success"
                                        role="alert"></div>
                                    Hola, {{ auth()->user()->nombre }}.<br>
                                    Estas a punto de cancelar la venta del objeto {{ $objeto->titulo }}.<br>
                                    ¿Estas seguro que quieres cancelar la venta?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <form class="confirmDeleteVenta{{ $objeto->id }}">
                                        @csrf
                                        <input type="hidden" name="webVentaId" value="{{ $objeto->id }}">
                                        <input type="hidden" name="compraId" value="{{ $objeto->compra_id }}">
                                        <input type="hidden" name="objetoId" value="{{ $objeto->objeto_id }}">
                                        <input type="hidden" name="userId" value="{{ $objeto->usuario_id }}">
                                        <button type="submit" class="btn btn-primary">Sí</button>
                                    </form>
                                </div>
                                <script>
                                    var updateVentasMias = false;
                                    $("#succesDeleteVenta{{ $objeto->id }}").fadeOut();
                                    $(document).ready(function() {
                                        $(".confirmDeleteVenta{{ $objeto->id }}").on('submit', function(event) {
                                            event.preventDefault();
                                            $("#succesDeleteVenta{{ $objeto->id }}").fadeOut();

                                            $.ajax({
                                                url: "{{ route('eliminar.user.venta') }}",
                                                method: 'POST',
                                                data: new FormData(this),
                                                dataType: 'json',
                                                contentType: false,
                                                cache: false,
                                                processData: false,
                                                success: function(data) {
                                                    $("#succesDeleteVenta{{ $objeto->id }}")
                                                        .fadeIn();
                                                    $("#succesDeleteVenta{{ $objeto->id }}")
                                                        .text(
                                                            data
                                                            .content);
                                                    updateVentasMias = true;
                                                }
                                            })
                                        });
                                        $('#cancelarVenta{{ $objeto->id }}').on('hidden.bs.modal', function() {
                                            if (updateVentasMias == true) {
                                                obtener_Mochila();
                                                cargar_mis_ventas();
                                                updateVentasMias = false;
                                            }

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<br><br><br><br><br><br><br>
