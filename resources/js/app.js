
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import {routes} from './routes';
Vue.use(VueRouter);

import Swal from 'sweetalert2'
 window.Swal = Swal

 import vSelect from "vue-select";

 Vue.component("v-select", vSelect);
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router
});
