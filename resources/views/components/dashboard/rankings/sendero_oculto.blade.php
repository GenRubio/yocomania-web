<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-sendero-semanal-tab" data-toggle="tab" href="#nav-sendero-semanal"
            role="tab" aria-controls="nav-sendero-semanal" aria-selected="true"><strong>Semanal Sendero
                Oculto</strong></a>
        <a class="nav-item nav-link" id="nav-sendero-global-tab" data-toggle="tab" href="#nav-sendero-global"
            role="tab" aria-controls="nav-sendero-global" aria-selected="true"><strong>Global Sendero
                Oculto</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-sendero-semanal" role="tabpanel" aria-labelledby="nav-sendero-semanal-tab">
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
            <form id="formSenderoSemanal" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorSenderoSemanal" name="jugador" type="text" maxlength="13" class="form-control"
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
            <tbody id="senderoSemanal" style="font-size: 16px;"></tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-sendero-global" role="tabpanel"
        aria-labelledby="nav-sendero-global-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formSenderoGlobal" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorSenderoGlobal" name="jugador" type="text" maxlength="13" class="form-control"
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
            <tbody id="senderoGlobal" style="font-size: 16px;"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        ///Sistema de busqueda de personas en ranking
        buscar_global_sendero();
        buscar_semanal_sendero();
        obtener_tops();

        function obtener_tops() {
            $.ajax({
                url: "{{ route('ranking.sendero.semanal.tops') }}",
                method: 'GET',
                success: function(data) {
                    $('#primerosPuestosTable').html(data.content);
                }
            })
        }
        $(document).on('keyup', '#buscadorSenderoGlobal', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_global_sendero();
            } else {
                buscar_global_sendero(query);
            }
        });
        $(document).on('keyup', '#buscadorSenderoSemanal', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_semanal_sendero();
            } else {
                buscar_semanal_sendero(query);
            }
        });
        function buscar_semanal_sendero(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.sendero.semanal') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#senderoSemanal').html(data.content);
                }
            })
        }
        function buscar_global_sendero(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.sendero.global') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#senderoGlobal').html(data.content);
                }
            })
        }
        $("#formSenderoGlobal").on('submit', function(event) {
            event.preventDefault();
            buscar_global_sendero($("#buscadorSenderoGlobal").val());
        });
        $("#formSenderoSemanal").on('submit', function(event) {
            event.preventDefault();
            buscar_semanal_sendero($("#buscadorSenderoSemanal").val());
        });
    });

</script>
