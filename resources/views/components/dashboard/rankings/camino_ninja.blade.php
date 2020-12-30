<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-ninja-global-tab" data-toggle="tab" href="#nav-ninja-global"
            role="tab" aria-controls="nav-ninja-global" aria-selected="true"><strong>Global Camino Ninja</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-ninja-global" role="tabpanel"
        aria-labelledby="nav-ninja-global-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formNinjaGlobal" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorNinjaGlobal" name="jugador" type="text" maxlength="13" class="form-control" placeholder="Jugador"
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
            <tbody id="ninjaGlobal" style="font-size: 16px;"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        ///Sistema de busqueda de personas en ranking
        buscar_global_ninja();

        $(document).on('keyup', '#buscadorNinjaGlobal', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_global_ninja();
            } else {
                buscar_global_ninja(query);
            }
        });
        function buscar_global_ninja(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.ninja.global') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#ninjaGlobal').html(data.content);
                }
            })
        }
        $("#formNinjaGlobal").on('submit', function(event) {
            event.preventDefault();
            buscar_global_ninja($("#buscadorNinjaGlobal").val());
        });
    });

</script>