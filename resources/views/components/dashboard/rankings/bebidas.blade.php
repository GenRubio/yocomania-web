<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-bebidas-enviados-tab" data-toggle="tab" href="#nav-bebidas-enviados"
            role="tab" aria-controls="nav-bebidas-enviados" aria-selected="true"><strong>Bebidas Enviadas</strong></a>
        <a class="nav-item nav-link" id="nav-bebidas-recibidos-tab" data-toggle="tab" href="#nav-bebidas-recibidos"
            role="tab" aria-controls="nav-bebidas-recibidos" aria-selected="false"><strong>Bebidas Recibidas</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-bebidas-enviados" role="tabpanel"
        aria-labelledby="nav-bebidas-enviados-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formBebidasEnavidos" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorBebidasEnviados" name="jugador" type="text" maxlength="13" class="form-control" placeholder="Jugador"
                        value="{{ auth()->user()->nombre }}">
                </div>
                <button type="submit" class="btn btn-primary mb-2"><strong>Buscar</strong></button>
            </form>
        </div>

        <table class="table rounded border table-fixed">
            <thead>
                <tr>
                    <th scope="col">Puesto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Puntos</th>
                    <th scope="col">Nivel</th>
                </tr>
            </thead>
            <tbody id="bebidasEnviados" style="font-size: 16px;"></tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-bebidas-recibidos" role="tabpanel" aria-labelledby="nav-bebidas-recibidos-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formBebidasRecibidos" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorBebidasRecibidos" type="text" maxlength="13" class="form-control" placeholder="Jugador"
                        value="{{ auth()->user()->nombre }}">
                </div>
                <button type="submit" class="btn btn-primary mb-2"><strong>Buscar</strong></button>
            </form>
        </div>
        <table class="table rounded border table-fixed">
            <thead>
                <tr>
                    <th scope="col">Puesto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Puntos</th>
                    <th scope="col">Nivel</th>
                </tr>
            </thead>
            <tbody id="bebidasRecibidos" style="font-size: 16px;"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        ///Sistema de busqueda de personas en ranking
        buscar_bebidas_enviados();
        buscar_bebidas_recibidos();

        $(document).on('keyup', '#buscadorBebidasEnviados', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_bebidas_enviados();
            } else {
                buscar_bebidas_enviados(query);
            }
        });
        $(document).on('keyup', '#buscadorBebidasRecibidos', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_bebidas_recibidos();
            } else {
                buscar_bebidas_recibidos(query);
            }
        });
        function buscar_bebidas_recibidos(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.bebidas.recibidos') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#bebidasRecibidos').html(data.content);
                }
            })
        }
        function buscar_bebidas_enviados(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.bebidas.enaviados') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#bebidasEnviados').html(data.content);
                }
            })
        }
        $("#formBebidasEnavidos").on('submit', function(event) {
            event.preventDefault();
            buscar_bebidas_enviados($("#buscadorBebidasEnviados").val());
        });
        $("#formBebidasRecibidos").on('submit', function(event) {
            event.preventDefault();
            buscar_bebidas_recibidos($("#buscadorBebidasRecibidos").val());
        });
    });

</script>