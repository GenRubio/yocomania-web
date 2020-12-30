const Utils = require('./Utils')

const RecoverPasswordController = {
    recoverPassworEl:{
        selector: '.recover-password-section-js'
    },
    routes: {
        getRecoverPassword: 'get-send-new-password'
    },

    init(){
        if(!Utils.checkSection(this.recoverPassworEl.selector)) return false;
        this.disabledErrorTags();
        this.setListener();
    },
    disabledErrorTags(){
        $("#succesSendEmail").fadeOut();
    }, 
    setListener(){
        $(document).on('submit', '#recuperarContraseña', event => { this.submitRecoverPasswordHandler(event) });
    },

    submitRecoverPasswordHandler(event){
        event.preventDefault();
        const url = Utils.getUrl(this.routes.getRecoverPassword);

        $("#nombreRecoverError").fadeOut();
        $("#emailRecoverError").fadeOut();

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(event.currentTarget),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.content == "error") {
                    $("#nombreRecoverError").text("Los datos no son correctos.")
                        .fadeIn();
                } else {
                    $("#recuperarContraseña")[0].reset();
                    $("#succesSendEmail").text(data.content);
                    $("#succesSendEmail").fadeIn();
                }
            },
            error: function(error) {
                if (error.responseJSON.errors.nombreRecover) {
                    $("#nombreRecoverError").text(error.responseJSON.errors
                            .nombreRecover)
                        .fadeIn();
                }
                if (error.responseJSON.errors.emailRecover) {
                    $("#emailRecoverError").text(error.responseJSON.errors
                            .emailRecover)
                        .fadeIn();
                }
            }
        })
    }
}

module.exports = RecoverPasswordController;