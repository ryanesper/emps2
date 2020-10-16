require('./bootstrap');

import Vue from 'vue'
import router from './router.js'

Vue.component('App', require('./components/AppComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#app',
    router
});
