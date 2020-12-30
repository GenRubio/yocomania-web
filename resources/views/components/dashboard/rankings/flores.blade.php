<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-flores-enviados-tab" data-toggle="tab" href="#nav-flores-enviados"
            role="tab" aria-controls="nav-flores-enviados" aria-selected="true"><strong>Flores Enviadas</strong></a>
        <a class="nav-item nav-link" id="nav-flores-recibidos-tab" data-toggle="tab" href="#nav-flores-recibidos"
            role="tab" aria-controls="nav-flores-recibidos" aria-selected="false"><strong>Flores Recibidas</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-flores-enviados" role="tabpanel"
        aria-labelledby="nav-flores-enviados-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formFloresEnavidos" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorFloresEnviados" name="jugador" type="text" maxlength="13" class="form-control" placeholder="Jugador"
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
            <tbody id="floresEnviados" style="font-size: 16px;"></tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-flores-recibidos" role="tabpanel" aria-labelledby="nav-flores-recibidos-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formFloresRecibidos" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorFloresRecibidos" type="text" maxlength="13" class="form-control" placeholder="Jugador"
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
            <tbody id="floresRecibidos" style="font-size: 16px;"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        ///Sistema de busqueda de personas en ranking
        buscar_flores_enviados();
        buscar_flores_recibidos();

        $(document).on('keyup', '#buscadorFloresEnviados', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_flores_enviados();
            } else {
                buscar_flores_enviados(query);
            }
        });
        $(document).on('keyup', '#buscadorFloresRecibidos', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_flores_recibidos();
            } else {
                buscar_flores_recibidos(query);
            }
        });
        function buscar_flores_recibidos(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.flores.recibidos') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#floresRecibidos').html(data.content);
                }
            })
        }
        function buscar_flores_enviados(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.flores.enaviados') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#floresEnviados').html(data.content);
                }
            })
        }
        $("#formFloresEnavidos").on('submit', function(event) {
            event.preventDefault();
            buscar_flores_enviados($("#buscadorFloresEnviados").val());
        });
        $("#formFloresRecibidos").on('submit', function(event) {
            event.preventDefault();
            buscar_flores_recibidos($("#buscadorFloresRecibidos").val());
        });
    });

</script>