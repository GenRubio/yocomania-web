<br>
<div class="container shadow-lg rounded p-3" style="background-color: white;">
    <div class="d-flex justify-content-center">
        <form id="buscarTodasPersonas" class="form-inline">
            @csrf
            <div class="form-group m-2 col-xs-5">
                <input name="search-live-person" id="search-live-person" type="text" class="form-control" maxlength="13"
                    placeholder="Nombre de Yocomaniaco">
            </div>
            <button type="submit" class="btn btn-primary"><strong>Buscar</strong></button>
        </form>
    </div>
</div>
<br>

<div class="container shadow-lg rounded p-3" style="background-color: white;">
    <div id="resultadoAmigos"></div>
</div>
<script>
    $(document).ready(function() {
        obtenerRecomendaciones();

        function obtenerRecomendaciones() {
            $.ajax({
                url: "{{ route('obtener.recomendaciones.amigos') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    $('#resultadoAmigos').html(data.content);
                }
            });
        }
        ///Sistema de busqueda de amigos Live
        $(document).on('keyup', '#search-live-person', function() {
            var query = $(this).val();
            if (query == "") {
                obtenerRecomendaciones();
            } else {
                buscar_amigo(query);
            }
        });

        function buscar_amigo(query = '_token:34d1230132d|@rim3d2323d') {
            $.ajax({
                url: "{{ route('buscar.yocomaniaco.tag') }}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#resultadoAmigos').html(data.content);
                }
            })
        }
        //****************************************************************
        //Buscar todas concidencias
        $("#buscarTodasPersonas").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('buscar.yocomaniacos.todos') }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#resultadoAmigos').html(data.content);
                }
            })
        });
        ///Pagination controller
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            let ruta = $(this).attr('href').toString();
            if (ruta.includes("user/amigos/buscar") || ruta.includes("/user/paginate/friends")) {
                var page = $(this).attr('href').split('page=')[1];
                buscar_contenido_amigos(page);
            }
        });

        function buscar_contenido_amigos(page) {
            $.ajax({
                url: "/user/paginate/friends?page=" + page,
                data: {
                    search_live_person: $("#search-live-person").val()
                },
                success: function(data) {
                    $('#resultadoAmigos').html(data.content);
                }
            });
        }
    });

</script>
