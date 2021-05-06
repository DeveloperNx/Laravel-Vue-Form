require('./bootstrap');
// window.Vue = require('vue');
import Vue from 'vue';
import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios'
import axios from 'axios';
import { routes } from './routes';
import Vuelidate from 'vuelidate';    
import 'vuejs-datatable/dist/themes/bootstrap-4.esm';
import { VuejsDatatableFactory } from 'vuejs-datatable';
 
/**
	 * Next, we will create a fresh Vue application instance and attach it to
	 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter);
Vue.use(VueAxios,axios);
Vue.use(Vuelidate);
Vue.use( VuejsDatatableFactory );

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
 
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
