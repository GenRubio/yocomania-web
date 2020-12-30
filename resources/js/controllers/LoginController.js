const Utils = require('./Utils')

const LoginController = {
    loginEl:{
        selector: '.login-section-js'
    },
    init(){
        if (!Utils.checkSection(this.loginEl.selector))return false;
        this.loginHadler();
    },
    loginHadler(){
      
    }
}
module.exports = LoginController;