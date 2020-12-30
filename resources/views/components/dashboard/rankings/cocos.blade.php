<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-cocos-enviados-tab" data-toggle="tab" href="#nav-cocos-enviados"
            role="tab" aria-controls="nav-cocos-enviados" aria-selected="true"><strong>Cocos Enviados</strong></a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-cocos-enviados" role="tabpanel"
        aria-labelledby="nav-cocos-enviados-tab">
        <div class="d-flex justify-content-center mt-2 mb-2">
            <form id="formCocosEnavidos" class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <input id="buscadorCocosEnviados" name="jugador" type="text" maxlength="13" class="form-control" placeholder="Jugador"
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
            <tbody id="cocosEnviados" style="font-size: 16px;"></tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        ///Sistema de busqueda de personas en ranking
        buscar_cocos_enviados();

        $(document).on('keyup', '#buscadorCocosEnviados', function() {
            var query = $(this).val();
            if (query == "") {
                buscar_cocos_enviados();
            } else {
                buscar_cocos_enviados(query);
            }
        });
        function buscar_cocos_enviados(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('ranking.cocos.enaviados') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#cocosEnviados').html(data.content);
                }
            })
        }
        $("#formCocosEnavidos").on('submit', function(event) {
            event.preventDefault();
            buscar_cocos_enviados($("#buscadorCocosEnviados").val());
        });
    });

</script>