const LoginController = require('./controllers/LoginController');
const PlantillaController = require('./controllers/PlantillaController');
//const RecoverPasswordAutController = require('./controllers/RecoverPasswordAutController');
//const RecoverPasswordController = require('./controllers/RecoverPasswordController');

const ViewHandler = {
    init() {
       document.addEventListener('DOMContentLoaded', () => {
        this.onDocumentReady();
       });
    },

    onDocumentReady() {
        // Init controllers
        PlantillaController.init();
        //RecoverPasswordAutController.init();
        //RecoverPasswordController.init();
        LoginController.init();
    },
};

module.exports = ViewHandler;