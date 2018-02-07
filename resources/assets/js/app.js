
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//import Vue from 'vue';

import VeeValidate from 'vee-validate';
import ElementUI from 'element-ui';
import DataTables from 'vue-data-tables';


/*
const config = {
    errorBagName: 'errors', // change if property conflicts
    fieldsBagName: 'fields',
    delay: 0,
    locale: 'uk',
    dictionary: null,
    strict: true,
    classes: false,
    classNames: {
        touched: 'touched', // the control has been blurred
        untouched: 'untouched', // the control hasn't been blurred
        valid: 'valid', // model is valid
        invalid: 'invalid', // model is invalid
        pristine: 'pristine', // control has not been interacted with
        dirty: 'dirty' // control has been interacted with
    },
    events: 'input|blur',
    inject: true,
    validity: false,
    aria: true,
    i18n: null, // the vue-i18n plugin instance
    i18nRootKey: 'validations' // the nested key under which the validation messsages will be located
};
*/

Vue.use(VeeValidate);

Vue.use(ElementUI);
Vue.use(DataTables);

Vue.component('app-employees', require('./components/employees/ListComponent.vue'));
Vue.component('app-employee-form', require('./components/employees/FormComponent.vue'));
Vue.component('app-positions', require('./components/positions/ListComponent.vue'));
Vue.component('app-positions-form', require('./components/positions/FormComponent.vue'));

Vue.filter('formatMoney', (value) => {
    return Number(value)
        .toFixed(2)
        .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
});


if(document.getElementById("app")) {
    const app = new Vue({
        el: '#app',
        //render: h => h(App),
        components: {

        }
    });
}
