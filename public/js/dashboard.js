$(document).ready(function() {
    var focusYocomaniacoSearch = false;
    var textYocomaniacoSearch = false;
    var detectOpenChat = false;
    obtener_Bpads();

    setInterval(function() {
        if (detectOpenChat){
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
        $(".nombre-pad").html(`<a href="` + userProfileRoute + `" style="text-decoration: none;">` + to_user_name + `</a>`);
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
