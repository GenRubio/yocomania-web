<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-uppercuts-semanal-tab" data-toggle="tab"
            href="#nav-uppercuts-semanal" role="tab" aria-controls="nav-uppercuts-semanal"
            aria-selected="true"><strong>Semanal Uppercuts</strong></a>
        <a class="nav-item nav-link" id="nav-uppercuts-enviados-tab" data-toggle="tab" href="#nav-uppercuts-enviados"
            role="tab" aria-controls="nav-uppercuts-enviados" aria-selected="true"><strong>Global Uppercuts</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-uppercuts-semanal" role="tabpanel"
        aria-labelledby="nav-uppercuts-semanal-tab">

        <div id="primerosPuestos">
            <div class="container">
                <div class="row border p-2 mt-2" style="height: 45px">
                    <div class="col">
                        <strong>Puesto</strong>
                    </div>
                    <div class="col">
                        <strong>Nombre</strong>
                    </div>
                    <div class="col">
                        <strong>Puntos</strong>
                    </div>
                    <div class="col">
                        <strong>Premio</strong>
                    </div>
                </div>
                <div class="shadow rounded" id="primerosPuestosTable"></div>
            </div>

        </div>
        <br>
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formUppercutsSemanal" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorUppercutsSemanal" name="jugador" type="text" maxlength="13" class="form-control"
                        placeholder="Jugador" value="{{ auth()->user()->nombre }}">
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
            <tbody id="uppercutsSemanal" style="font-size: 16px;"></tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-uppercuts-enviados" role="tabpanel" aria-labelledby="nav-uppercuts-enviados-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formUppercutsEnavidos" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorUppercutsEnviados" name="jugador" type="text" maxlength="13" class="form-control"
                        placeholder="Jugador" value="{{ auth()->user()->nombre }}">
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
            <tbody id="uppercutsEnviados" style="font-size: 16px;"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        ///Sistema de busqueda de personas en ranking
        buscar_uppercuts_enviados();
        buscar_uppercuts_semanal();
        obtener_tops();

        $(document).on('keyup', '#buscadorUppercutsEnviados', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_uppercuts_enviados();
            } else {
                buscar_uppercuts_enviados(query);
            }
        });
        $(document).on('keyup', '#buscadorUppercutsSemanal', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_uppercuts_semanal();
            } else {
                buscar_uppercuts_semanal(query);
            }
        });

        function obtener_tops() {
            $.ajax({
                url: "{{ route('ranking.uppercuts.semanal.tops') }}",
                method: 'GET',
                success: function(data) {
                    $('#primerosPuestosTable').html(data.content);
                }
            })
        }

        function buscar_uppercuts_semanal(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.uppercuts.semanal') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#uppercutsSemanal').html(data.content);
                }
            })
        }

        function buscar_uppercuts_enviados(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.uppercuts.enaviados') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#uppercutsEnviados').html(data.content);
                }
            })
        }
        $("#formUppercutsEnavidos").on('submit', function(event) {
            event.preventDefault();
            buscar_uppercuts_enviados($("#buscadorUppercutsEnviados").val());
        });
        $("#formUppercutsSemanal").on('submit', function(event) {
            event.preventDefault();
            buscar_uppercuts_semanal($("#buscadorUppercutsSemanal").val());
        });
    });

</script>
