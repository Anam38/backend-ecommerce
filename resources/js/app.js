
require('./bootstrap');

window.Vue = require('vue').default;
window.$ = window.jQuery = require('jquery');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import router from './routes/routes';
import Auth from './middleware/Auth.js';

Vue.use(VueRouter);
Vue.prototype.auth = Auth;
Vue.use(VueAxios, axios);

Vue.component('auth-component', require('./components/AuthComponent.vue').default);
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('content-component', require('./components/ContentComponent.vue').default);
Vue.component('sidebarmenu-component', require('./components/SidebarMenuComponent.vue').default);
Vue.component('footer-component', require('./components/FooterComponent.vue').default);


const app = new Vue({
    el: '#app',
    router: router,
});
