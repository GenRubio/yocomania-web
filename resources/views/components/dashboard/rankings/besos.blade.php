
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-besos-enviados-tab" data-toggle="tab" href="#nav-besos-enviados"
            role="tab" aria-controls="nav-besos-enviados" aria-selected="true"><strong>Besos Enviados</strong></a>
        <a class="nav-item nav-link" id="nav-besos-recibidos-tab" data-toggle="tab" href="#nav-besos-recibidos"
            role="tab" aria-controls="nav-besos-recibidos" aria-selected="false"><strong>Besos Recibidos</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-besos-enviados" role="tabpanel"
        aria-labelledby="nav-besos-enviados-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formBesosEnavidos" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorBesosEnviados" name="jugador" type="text" maxlength="13" class="form-control" placeholder="Jugador"
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
            <tbody id="besosEnviados" style="font-size: 16px;"></tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-besos-recibidos" role="tabpanel" aria-labelledby="nav-besos-recibidos-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formBesosRecibidos" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorBesosRecibidos" type="text" maxlength="13" class="form-control" placeholder="Jugador"
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
            <tbody id="besosRecibidos" style="font-size: 16px;"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        ///Sistema de busqueda de personas en ranking
        buscar_besos_enviados();
        buscar_besos_recibidos();

        $(document).on('keyup', '#buscadorBesosEnviados', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_besos_enviados();
            } else {
                buscar_besos_enviados(query);
            }
        });
        $(document).on('keyup', '#buscadorBesosRecibidos', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_besos_recibidos();
            } else {
                buscar_besos_recibidos(query);
            }
        });
        function buscar_besos_recibidos(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.besos.recibidos') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#besosRecibidos').html(data.content);
                }
            })
        }
        function buscar_besos_enviados(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.besos.enaviados') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#besosEnviados').html(data.content);
                }
            })
        }
        $("#formBesosEnavidos").on('submit', function(event) {
            event.preventDefault();
            buscar_besos_enviados($("#buscadorBesosEnviados").val());
        });
        $("#formBesosRecibidos").on('submit', function(event) {
            event.preventDefault();
            buscar_besos_recibidos($("#buscadorBesosRecibidos").val());
        });
    });

</script>

