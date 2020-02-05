require('./bootstrap');

window.Vue = require('vue');

import VueRouter from "vue-router"
import router from "./routes";
import App from './components/App'

import {ValidationProvider, ValidationObserver} from 'vee-validate';

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);

Vue.use(VueRouter)

Vue.component('app', App);


new Vue({
    el: '#app',
    router
});
