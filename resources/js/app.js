require('./bootstrap');

window.Vue = require('vue');

import VueRouter from "vue-router"
import router from "./routes";
import App from './components/App'

import zh_TW from 'vee-validate/dist/locale/zh_TW';
import VeeValidate, {Validator} from 'vee-validate';

Validator.localize('zh_TW', zh_TW);

Vue.use(VeeValidate, {
    locale: 'zh_TW'
})

Vue.use(VueRouter)
// Vue.use(VeeValidate)

Vue.component('app', App);


new Vue({
    el: '#app',
    router
});
