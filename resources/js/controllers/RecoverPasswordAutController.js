const Utils = require('./Utils')

const RecoverPasswordAutController = {
    revoverPasswordAuthEl:{
        selector: '.recover-password-auth-section-js'
    },

    routes: {
        getRecoverPasswordValidate: 'get-recover-password-validate',
        redirectMe: 'redirect-me'
    },

    init(){
        if (!Utils.checkSection(this.revoverPasswordAuthEl.selector)) return false;
        this.setListeners();
        this.validatePassword();
    },

    setListeners() {
        // $("#cambiarContraseña").on('submit', function(event) 
        $(document).on('submit', '#cambiarContraseña',  event => { this.submitChangePasswordHandler(event) });
    },

    submitChangePasswordHandler(event) {
        event.preventDefault();
        const url = Utils.getUrl(this.routes.getRecoverPasswordValidate);
        const redirectUrl = Utils.getUrl(this.routes.redirectMe);
 
        $("#passwordRecoverError").fadeOut();
        $("#passwordRepiteRecoverError").fadeOut();

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(event.currentTarget),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#cambiarContraseña")[0].reset();
                location.href = redirectUrl;
            },
            error: function(error) {
                if (error.responseJSON.errors.passwordRecover) {
                    $("#passwordRecoverError").text(error.responseJSON.errors
                            .passwordRecover)
                        .fadeIn();
                }
                if (error.responseJSON.errors.passwordRepiteRecover) {
                    $("#passwordRepiteRecoverError").text(error.responseJSON.errors
                            .passwordRepiteRecover)
                        .fadeIn();
                }
            }
        })
    },

    validatePassword(){
        
    }
}

module.exports = RecoverPasswordAutController;