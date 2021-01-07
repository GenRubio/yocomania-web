<div class="row text-center justify-content-center">
    @foreach ($fichas as $ficha)
        <a type="button" class="col-sm-6 col-md-4 col-lg-3 border rounded shadow m-3 p-0" style="height: 310px;
            background-repeat: no-repeat;
            background-position: center;
            background-image: url('{{ url('/images/Fichas/' . $ficha->ficha_img) }}');
            text-decoration: none;" data-toggle="modal" data-target="#comprarFicha{{ $ficha->id }}">
            <div class="d-flex justify-content-end flex-column" style="width: 100%; height: 100%;">
                <div style="background-color: #0000007a; height: 50px;">
                    <h4 class="mt-2"><strong style="color:whitesmoke">{{ $ficha->titulo }}</strong>
                        <h4>
                </div>
                <div class="rounded-bottom" style="background-color: #000000b8; height: 35px;">
                    <h6 class="mt-2"><strong style="color: gold">{{ $ficha->oro }} Créditos Oro</strong></h6>
                </div>
            </div>
        </a>
        <div class="modal fade" id="comprarFicha{{ $ficha->id }}" tabindex="-1" role="dialog"
            aria-labelledby="comprarFicha{{ $ficha->id }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="comprarFicha{{ $ficha->id }}Label">
                            <strong>{{ $ficha->titulo }}</strong>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="comprarFicha{{ $ficha->id }}">
                        @csrf
                        <div class="modal-body">
                            <div id="successCompraFicha{{ $ficha->id }}" class="alert alert-success" role="alert"></div>
                            <div class="text-left">
                                <p><strong>Precio:</strong> <strong style="color:#dc7e05">{{ $ficha->oro }}</strong>
                                    <strong>Créditos de Oro.</strong>
                                </p>
                                <p><strong>Descripción:</strong> {{ $ficha->titulo }}, puedes cambiar la ficha dentro
                                    del
                                    juego.<br>
                                    Puedes comprar la ficha como regalo para un amigo.<br>
                                    Marca la opción Regalo para amigo para regalar compra de ficha a un amigo.</p>
                            </div>
                            <img src="{{ url('/images/Fichas/' . $ficha->ficha_img) }}">
                            <div class="p-1"></div>
                            <div class="text-left">
                                <span id="errorFichaCompra{{ $ficha->id }}" style="color:red" class="help-block"></span>
                                <div class="form-check">
                                    <input name="amigo" class="form-check-input checkFriend{{ $ficha->id }}"
                                        type="checkbox" value="true">
                                    <label class="form-check-label" for="defaultCheck1">
                                        <strong>Regalo para amigo</strong>
                                    </label>
                                </div>
                                <div class="p-1"></div>
                                <div class="form-group">
                                    <input name="nombreAmigo" id="nameUser{{ $ficha->id }}" type="text"
                                        class="form-control" placeholder="Nombre de amigo" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="ficha" value="{{ $ficha->id }}">
                            <button type="submit" class="btn btn-primary"><strong>Comprar</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#nameUser{{ $ficha->id }}").prop('disabled', true);
                $("#errorFichaCompra{{ $ficha->id }}").fadeOut();
                $("#successCompraFicha{{ $ficha->id }}").fadeOut();

                $(document).on('change', '.checkFriend{{ $ficha->id }}', function() {
                    if (this.checked) {
                        $("#nameUser{{ $ficha->id }}").prop('disabled', false);
                    } else {
                        $("#nameUser{{ $ficha->id }}").prop('disabled', true);
                    }
                });

                $(".comprarFicha{{ $ficha->id }}").on('submit', function(event) {
                    event.preventDefault();
                    $("#errorFichaCompra{{ $ficha->id }}").fadeOut();
                    $("#successCompraFicha{{ $ficha->id }}").fadeOut();
                    $.ajax({
                        url: "{{ route('tienda.fichas.comprar') }}",
                        method: 'POST',
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data.error != "") {
                                $("#errorFichaCompra{{ $ficha->id }}").text(data.error)
                                    .fadeIn();
                            } else {
                                $("#successCompraFicha{{ $ficha->id }}").fadeIn();
                                $("#successCompraFicha{{ $ficha->id }}").text(data.content);
                            }
                        },
                    })
                });
            });

        </script>
    @endforeach
</div>
