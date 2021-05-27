import Vue from 'vue'
import http from "./services/https";
import {AlertPlugin, ButtonPlugin, CardPlugin, FormGroupPlugin, FormInputPlugin, FormPlugin} from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.component('login-component', require('./components/Login.vue').default);

Vue.use(CardPlugin);
Vue.use(FormPlugin);
Vue.use(FormGroupPlugin);
Vue.use(FormInputPlugin);
Vue.use(ButtonPlugin);
Vue.use(AlertPlugin);

Vue.prototype.$http = http;

const app = new Vue({
    el: '#app'
})
