@extends('layouts.plantilla-perfil')

@section('header')
    <div
        style="background-image: url('{{ url('/images/homeBaner2.png') }}'); 
                                                                                                                                                                    background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div style="height: 266px;"></div>
        </div>
    </div>
@endsection

@section('content')
    <div class="ml-0 mr-0">
        <div class="row">
            <div class="col shadow-lg rounded" style="background-color: white;">
                <nav>
                    <div class="nav nav-tabs mt-2" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                            aria-controls="nav-home" aria-selected="true"><strong>{{ $usuario->nombre }}</strong></a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <br>
                        <div class="container shadow-lg rounded" style="background-color: white;">
                            @include('components.perfilUsuario._perfil', ['usuario' => $usuario, 'friend' => 'true'])
                        </div>
                        <br> <br>
                        <nav class="mb-2">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-estadistica-tab" data-toggle="tab"
                                    href="#nav-estadistica" role="tab" aria-controls="nav-estadistica"
                                    aria-selected="true"><strong>Estadística</strong></a>
                                <a class="nav-item nav-link" id="nav-armario-tab" data-toggle="tab" href="#nav-armario"
                                    role="tab" aria-controls="nav-armario" aria-selected="false"><strong>Armario
                                        Kekos</strong></a>
                                <a class="nav-item nav-link" id="nav-fichas-tab" data-toggle="tab" href="#nav-fichas"
                                    role="tab" aria-controls="nav-fichas" aria-selected="false"><strong>Fichas</strong></a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-estadistica" role="tabpanel"
                                aria-labelledby="nav-estadistica-tab">
                                <div class="container shadow-lg rounded" style="background-color: white;">

                                    @include('components.perfilUsuario._estadisticas', ['usuario' => $usuario])

                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-armario" role="tabpanel" aria-labelledby="nav-armario-tab">
                                ...</div>
                            <div class="tab-pane fade" id="nav-fichas" role="tabpanel" aria-labelledby="nav-fichas-tab">
                                <div class="container shadow-lg rounded" style="background-color: white;">

                                    @include('components.perfilUsuario._fichas', ['usuario' => $usuario, 'friend' =>
                                    'true'])

                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="container shadow-lg rounded" style="background-color: white;">
                            @include('components.perfilUsuario._socialNetwork')
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-md-auto"></div>
            <hr>
            <div class="col col-lg-3 p-0">
                <div class="d-flex flex-column shadow-lg rounded" style="background-color: white;">
                    <div class="m-2">
                        @include('components.perfilUsuario._bPads')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex">
                        <div>
                            <!-- include -->
                            <div id="avatarPad"></div>
                        </div>
                        <div>
                            <h3 class="modal-title ml-2 mt-3 nombre-pad" id="exampleModalLabel"
                                style="color: #3490dc; font-weight: bold;"></h3>
                        </div>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var focusYocomaniacoSearch = false;
            var textYocomaniacoSearch = false;
            var detectOpenChat = false;
            obtener_Bpads();

            setInterval(function() {
                if (detectOpenChat) {
                    update_chat_history_data();
                }
            }, 5000);

            setInterval(function() {
                if (focusYocomaniacoSearch == false) {
                    update_last_activity();
                    obtener_Bpads();
                }
            }, 10000);
            ///Desactivamos la busqueda de Bpads al hacer focus en filtro
            $(document).on('focus', '#yocomaniaco', function() {
                focusYocomaniacoSearch = true;
            });
            $(document).on('blur', '#yocomaniaco', function() {
                if (textYocomaniacoSearch == false) {
                    focusYocomaniacoSearch = false;
                }
            });
            ///Sistema de busqueda de amigos
            $(document).on('keyup', '#yocomaniaco', function() {
                var query = $(this).val();
                if (query == "") {
                    focusYocomaniacoSearch = false;
                    textYocomaniacoSearch = false;
                } else {
                    buscar_amigo_bpad(query);
                }
            });

            function buscar_amigo_bpad(query = '_token:34d1230132d|@rim3d2323d') {
                $.ajax({
                    url: "{{ route('buscar.yocomaniaco') }}",
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#bPads_section').html(data.content);
                    }
                })
            }
            //****************************************************************

            function obtener_Bpads() {
                $.ajax({
                    url: "{{ route('obtener.bpads') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#bPads_section').html(data.content);
                    }
                });
            }

            function update_last_activity() {
                $.ajax({
                    url: "{{ route('update.activity.pad') }}",
                    method: "GET",
                    success: function() {}
                });
            }

            function make_chat_dialog_box(to_user_id, to_user_name) {
                var modal_content = '<div id="user_dialog_' + to_user_id +
                    '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
                modal_content +=
                    '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' +
                    to_user_id + '" id="chat_history_' + to_user_id + '">';
                modal_content += fetch_user_chat_history(to_user_id)
                modal_content += '</div>';
                modal_content += '<div class="form-group">';
                modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id +
                    '" class="form-control"></textarea>';
                modal_content += '</div><div class="form-group" align="right">';
                modal_content += '<button type="button" name="send_chat" id="' + to_user_id +
                    '" class="btn btn-primary send_chat">Enviar</button></div></div>';
                $('.modal-body').html(modal_content);
                detectOpenChat = true;
            }
            $("#exampleModal").on('hidden.bs.modal', function() {
                detectOpenChat = false;
                $('.modal-body').html("");
            });
            $(document).on('click', '.start_chat', function() {

                var to_user_id = $(this).data('touserid');
                var to_user_name = $(this).data('tousername');
                $.ajax({
                    url: "{{ route('obtener.avatar.pad') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        to_user_id: to_user_id
                    },
                    success: function(data) {
                        $('#avatarPad').html(data.content);
                    }
                })
                //Subnormal nunca hagas esto no pongas una puta clase generica

                let userProfileRoute = "{{ route('look.user.profile', ':usuario') }}";
                userProfileRoute = userProfileRoute.replace(':usuario', to_user_name);
                $(".nombre-pad").html(`<a href="` + userProfileRoute + `" style="text-decoration: none;">` +
                    to_user_name + `</a>`);
                make_chat_dialog_box(to_user_id, to_user_name);
            });

            $(document).on('click', '.send_chat', function() {
                var to_user_id = $(this).attr('id');
                var chat_message = $('#chat_message_' + to_user_id).val();
                $.ajax({
                    url: "{{ route('inser.chat') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        to_user_id: to_user_id,
                        chat_message: chat_message
                    },
                    success: function(data) {
                        $('#chat_message_' + to_user_id).val('');
                        $('#chat_history_' + to_user_id).html(data.content);
                    }
                })
            });

            function fetch_user_chat_history(to_user_id) {
                $.ajax({
                    url: "{{ route('fetch.chat.history') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        to_user_id: to_user_id
                    },
                    success: function(data) {
                        $('#chat_history_' + to_user_id).html(data.content);
                    }
                })
            }

            function update_chat_history_data() {
                $('.chat_history').each(function() {
                    var to_user_id = $(this).data('touserid');
                    fetch_user_chat_history(to_user_id);
                });
            }
        });

    </script>
@endsection
