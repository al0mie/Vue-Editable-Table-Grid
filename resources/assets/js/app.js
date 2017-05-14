import Vue from 'vue';
import example from './components/Example.vue';
window.axios = require('axios');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    components: {
        'example' : example
    }
});
