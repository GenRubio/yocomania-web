<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-forbes-global-tab" data-toggle="tab" href="#nav-forbes-global"
            role="tab" aria-controls="nav-forbes-global" aria-selected="true"><strong>Yocomania Forbes</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-forbes-global" role="tabpanel"
        aria-labelledby="nav-forbes-global-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formForbesGlobal" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorForbesGlobal" name="jugador" type="text" maxlength="13" class="form-control" placeholder="Jugador"
                        value="{{ auth()->user()->nombre }}">
                </div>
                <button type="submit" class="btn btn-primary mb-2"><strong>Buscar</strong></button>
            </form>
        </div>
        <p style="color: grey">Para entrar en la lista de Forbes tu fortuna debe ser mayor a 100.000 Créditos de Oro</p>
        <table class="table rounded border table-fixed">
            <thead>
                <tr>
                    <th scope="col">Puesto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Créditos</th>
                    <th scope="col">Nivel</th>
                </tr>
            </thead>
            <tbody id="forbesGlobal" style="font-size: 16px;"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        ///Sistema de busqueda de personas en ranking
        buscar_global_forbes();

        $(document).on('keyup', '#buscadorForbesGlobal', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_global_forbes();
            } else {
                buscar_global_forbes(query);
            }
        });
        function buscar_global_forbes(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.forbes.global') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#forbesGlobal').html(data.content);
                }
            })
        }
        $("#formForbesGlobal").on('submit', function(event) {
            event.preventDefault();
            buscar_global_forbes($("#buscadorForbesGlobal").val());
        });
    });

</script>