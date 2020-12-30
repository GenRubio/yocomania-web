<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-cocos-locos-semanal-tab" data-toggle="tab"
            href="#nav-cocos-locos-semanal" role="tab" aria-controls="nav-cocos-locos-semanal"
            aria-selected="true"><strong>Semanal Golden Cocos</strong></a>
        <a class="nav-item nav-link" id="nav-silver-cocos-locos-tab" data-toggle="tab" href="#nav-silver-cocos-locos"
            role="tab" aria-controls="nav-silver-cocos-locos" aria-selected="true"><strong>Semanal Silver
                Cocos</strong></a>
        <a class="nav-item nav-link" id="nav-cocos-locos-global-tab" data-toggle="tab" href="#nav-cocos-locos-global"
            role="tab" aria-controls="nav-cocos-locos-global" aria-selected="true"><strong>Global Cocos
                Locos</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-silver-cocos-locos" role="tabpanel" aria-labelledby="nav-silver-cocos-locos-tab">
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
            <div class="shadow rounded" id="silverCocosLocosTop"></div>
        </div>
        <br>
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formSilverCocosLocos" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorSilverCocosLocos" name="jugador" type="text" maxlength="13" class="form-control"
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
            <tbody id="silverCocosLocos" style="font-size: 16px;"></tbody>
        </table>
    </div>
    <div class="tab-pane fade show active" id="nav-cocos-locos-semanal" role="tabpanel"
        aria-labelledby="nav-cocos-locos-semanal-tab">

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
            <form id="formCocosLocosSemanal" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorCocosLocosSemanal" name="jugador" type="text" maxlength="13" class="form-control"
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
            <tbody id="cocosLocosSemanal" style="font-size: 16px;"></tbody>
        </table>
    </div>
    <!-- Global Cocos Locos-->
    <div class="tab-pane fade" id="nav-cocos-locos-global" role="tabpanel" aria-labelledby="nav-cocos-locos-global-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formCocosLocosGlobal" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorCocosLocosGlobal" name="jugador" type="text" maxlength="13" class="form-control"
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
            <tbody id="cocosLocosGlobal" style="font-size: 16px;"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        ///Sistema de busqueda de personas en ranking
        buscar_global_cocos_locos();
        buscar_cocos_locos_semanal();
        buscar_silver_cocos_locos();
        obtener_tops();
        obtener_tops_silver();

        function obtener_tops() {
            $.ajax({
                url: "{{ route('ranking.cocos-locos.semanal.tops') }}",
                method: 'GET',
                success: function(data) {
                    $('#primerosPuestosTable').html(data.content);
                }
            })
        }
        function obtener_tops_silver() {
            $.ajax({
                url: "{{ route('ranking.cocos-locos.semanal.tops.silver') }}",
                method: 'GET',
                success: function(data) {
                    $('#silverCocosLocosTop').html(data.content);
                }
            })
        }

        $(document).on('keyup', '#buscadorCocosLocosSemanal', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_cocos_locos_semanal();
            } else {
                buscar_cocos_locos_semanal(query);
            }
        });
        $(document).on('keyup', '#buscadorCocosLocosGlobal', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_global_cocos_locos();
            } else {
                buscar_global_cocos_locos(query);
            }
        });
        $(document).on('keyup', '#buscadorSilverCocosLocos', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_silver_cocos_locos();
            } else {
                buscar_silver_cocos_locos(query);
            }
        });
        function buscar_silver_cocos_locos(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.cocos-locos.semanal.silver') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#silverCocosLocos').html(data.content);
                }
            })
        }
        function buscar_cocos_locos_semanal(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.cocos-locos.semanal') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#cocosLocosSemanal').html(data.content);
                }
            })
        }
        function buscar_global_cocos_locos(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.cocos-locos.global') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#cocosLocosGlobal').html(data.content);
                }
            })
        }
        $("#formCocosLocosGlobal").on('submit', function(event) {
            event.preventDefault();
            buscar_global_cocos_locos($("#buscadorCocosLocosGlobal").val());
        });
        $("#formCocosLocosSemanal").on('submit', function(event) {
            event.preventDefault();
            buscar_cocos_locos_semanal($("#buscadorCocosLocosSemanal").val());
        });
        $("#formSilverCocosLocos").on('submit', function(event) {
            event.preventDefault();
            buscar_silver_cocos_locos($("#buscadorSilverCocosLocos").val());
        });
    });

</script>
