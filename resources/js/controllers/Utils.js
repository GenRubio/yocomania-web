const RoutesHelper = require('./RoutesHelper');

const Utils = {
    checkSection(selector) {
        return document.querySelectorAll(selector).length;
    },

    getUrl: function(route, hasSlug = false) {
        let routesHelper = new RoutesHelper();
        // let slug = hasSlug ? this.getCatalogDetailConfig().slug : null;
        const routeEl = routesHelper.getRoute(
            route
        );
        return routeEl;
    },

    // getCatalogDetailConfig() {
    //     let e = window.app.catalog;
    //     if( 'undefined' == typeof e)
    //         throw new Error('This config does not exists. EMC01');
    //     return e;
    // },
};

module.exports = Utils;