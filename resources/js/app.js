
require('./bootstrap');

window.Vue = require('vue').default;
window.$ = window.jQuery = require('jquery');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import VCalendar from 'v-calendar';
import axios from 'axios';
import router from './routes/routes';
import Auth from './middleware/Auth.js';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VCalendar, {
  componentPrefix: 'vc',
});
Vue.prototype.auth = Auth;

import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

Vue.component('auth-component', require('./components/AuthComponent.vue').default);
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('content-component', require('./components/ContentComponent.vue').default);
Vue.component('sidebarmenu-component', require('./components/SidebarMenuComponent.vue').default);
Vue.component('footer-component', require('./components/FooterComponent.vue').default);
Vue.component('modal-component', require('./components/ModalComponent.vue').default);
Vue.component('calendar', Calendar)
Vue.component('date-picker', DatePicker)

const app = new Vue({
    el: '#app',
    router: router,
});
