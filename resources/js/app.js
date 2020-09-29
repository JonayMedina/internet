
require('./bootstrap');
import '@mdi/font/css/materialdesignicons.css';

import Vue from 'vue';
window.Vue = require('vue');
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
import {routes} from './routes.js';
import MainApp from './components/MainApp';
import Vuex from 'vuex';
import store from './store';
import {initialize} from './helpers/general';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Swal from 'sweetalert2';

import { Form, HasError, AlertError } from 'vform';

window.Form = Form
window.Swal = Swal;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.use(VueAxios, axios);
Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(Vuex);

const router = new VueRouter({
    mode: 'history',
    routes,
});

Vue.component('payment', require('./components/Payment.vue').default);

const vuetify = new Vuetify({
    theme: {
      themes: {
        light: {
          primary: '#ce0000',
          secondary: '#b0bec5',
          accent: '#8c9eff',
          error: '#b71c1c',
        },
      },
    },
  })

initialize(store,router);
const app = new Vue({
	el: '#app',
	store,
	router,
    vuetify,
    iconfont: 'mdi',
	components : {
        MainApp,
	},


});
