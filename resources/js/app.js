
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
    'inventory-list-component',
    require('./components/InventoryComponent.vue').default
);

Vue.component(
    'add-to-inventory-button',
    require('./components/AddToInventoryButtonComponent.vue').default
);

Vue.component(
    'remove-from-inventory-button',
    require('./components/RemoveFromInventoryButtonComponent.vue').default
);

Vue.component(
    'edit-army-left-panel',
    require('./components/EditArmyLeftPanel.vue').default
);

Vue.component(
    'army-list-component',
    require('./components/ArmyListComponent.vue').default
);

Vue.component(
    'add-to-army-button',
    require('./components/AddToArmyButtonComponent.vue').default
);

Vue.component(
    'remove-from-army-button',
    require('./components/RemoveFromArmyButtonComponent.vue').default
);

Vue.component(
    'army-points-cost',
    require('./components/ArmyPointsCost.vue').default
);

Vue.component(
    'army-unit-rank-count-display',
    require('./components/ArmyUnitRankCountDisplay.vue').default
);

Vue.component(
    'all-units-list',
    require('./components/AllUnitsComponent.vue').default
);

Vue.component(
    'floating-notification',
    require('./components/FloatingNotification.vue').default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

require('./custom');
