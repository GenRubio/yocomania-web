<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-ring-semanal-tab" data-toggle="tab" href="#nav-ring-semanal"
            role="tab" aria-controls="nav-ring-semanal" aria-selected="true"><strong>Semanal Golden Ring</strong></a>
        <a class="nav-item nav-link" id="nav-silver-ring-tab" data-toggle="tab" href="#nav-silver-ring" role="tab"
            aria-controls="nav-silver-ring" aria-selected="true"><strong>Semanal Silver Ring</strong></a>
        <a class="nav-item nav-link" id="nav-ring-global-tab" data-toggle="tab" href="#nav-ring-global" role="tab"
            aria-controls="nav-ring-global" aria-selected="true"><strong>Global Ring</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-silver-ring" role="tabpanel" aria-labelledby="nav-silver-ring-tab">
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
            <div class="shadow rounded" id="silverRingTop"></div>
        </div>
        <br>
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formSilverRing" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorSilverRing" name="jugador" type="text" maxlength="13" class="form-control"
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
            <tbody id="silverRing" style="font-size: 16px;"></tbody>
        </table>
    </div>
    <div class="tab-pane fade show active" id="nav-ring-semanal" role="tabpanel" aria-labelledby="nav-ring-semanal-tab">

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
            <form id="formRingSemanal" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorRingSemanal" name="jugador" type="text" maxlength="13" class="form-control"
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
            <tbody id="ringSemanal" style="font-size: 16px;"></tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-ring-global" role="tabpanel" aria-labelledby="nav-ring-global-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formRingGlobal" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorRingGlobal" name="jugador" type="text" maxlength="13" class="form-control"
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
            <tbody id="ringGlobal" style="font-size: 16px;"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        ///Sistema de busqueda de personas en ranking
        buscar_ring_global();
        buscar_ring_semanal();
        buscar_silver_ring();
        obtener_tops();
        obtener_tops_silver();


        $(document).on('keyup', '#buscadorSilverRing', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_silver_ring();
            } else {
                buscar_silver_ring(query);
            }
        });
        $(document).on('keyup', '#buscadorRingGlobal', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_ring_global();
            } else {
                buscar_ring_global(query);
            }
        });
        $(document).on('keyup', '#buscadorRingSemanal', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_ring_semanal();
            } else {
                buscar_ring_semanal(query);
            }
        });

        function obtener_tops() {
            $.ajax({
                url: "{{ route('ranking.ring.semanal.tops') }}",
                method: 'GET',
                success: function(data) {
                    $('#primerosPuestosTable').html(data.content);
                }
            })
        }

        function obtener_tops_silver() {
            $.ajax({
                url: "{{ route('ranking.ring.semanal.tops.silver') }}",
                method: 'GET',
                success: function(data) {
                    $('#silverRingTop').html(data.content);
                }
            })
        }

        function buscar_silver_ring(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.ring.semanal.silver') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#silverRing').html(data.content);
                }
            })
        }

        function buscar_ring_semanal(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.ring.semanal') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#ringSemanal').html(data.content);
                }
            })
        }

        function buscar_ring_global(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.ring.global') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#ringGlobal').html(data.content);
                }
            })
        }
        $("#formRingGlobal").on('submit', function(event) {
            event.preventDefault();
            buscar_ring_global($("#buscadorRingGlobal").val());
        });
        $("#formRingSemanal").on('submit', function(event) {
            event.preventDefault();
            buscar_ring_semanal($("#buscadorRingSemanal").val());
        });
        $("#formSilverRing").on('submit', function(event) {
            event.preventDefault();
            buscar_silver_ring($("#buscadorSilverRing").val());
        });
    });

</script>
