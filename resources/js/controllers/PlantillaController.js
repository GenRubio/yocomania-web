const Utils = require('./Utils');

const PlantillaController = {
    plantillaSectionEl: {
        selector: '.plantilla-section-js'
    },

    rightBarEl: {
        selector: '#barraDerecha'
    },
    eventBarEl:{
        selector: '#barraEventos'
    },
    barraLiveEl: {
        selector: '#barraLive'
    },

    init() {
        if( ! Utils.checkSection(this.plantillaSectionEl.selector) ) return false;
        this.extendRightBar();
    },

    extendRightBar() {
        const barraDerecha = $(this.rightBarEl.selector).height();
        const barraEventos = $(this.eventBarEl.selector).height();
        $(this.barraLiveEl.selector).height(barraDerecha - barraEventos);
    },



    setListeners() {

    }
};

module.exports = PlantillaController;