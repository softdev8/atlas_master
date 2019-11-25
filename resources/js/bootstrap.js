/**
 * jquery / bootstrap init
 */
try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * Axios init
 */
//window.axios = require('axios');
//window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//let token = document.head.querySelector('meta[name="csrf-token"]');
//if (token) {
//    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
//} else {
//    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
//}

/**
 * Vue js init
 */
//window.Vue = require('vue');
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//
//const app = new Vue({
//    el: '#app'
//});
