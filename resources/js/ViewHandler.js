const PlantillaController = require('./controllers/PlantillaController');
const RecoverPasswordAutController = require('./controllers/RecoverPasswordAutController');

const ViewHandler = {
    init() {
       document.addEventListener('DOMContentLoaded', () => {
        this.onDocumentReady();
       });
    },

    onDocumentReady() {
        // Init controllers
        PlantillaController.init();
        RecoverPasswordAutController.init();
    },
};

module.exports = ViewHandler;