import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueCurrencyInput from 'vue-currency-input';
import Vue2Filters from 'vue2-filters';
import Register from './Register';
import Transactions from './Transactions';

window.Vue = Vue;

const pluginOptions = {
    globalOptions: { currency: 'USD' },
};

Vue.use(VueCurrencyInput, pluginOptions);
Vue.use(VueRouter);
Vue.use(Vue2Filters);
Vue.component('main-menu', require('./MainMenu.vue').default);

const routes = [
    { path: '/', component: Register },
    { path: '/transactions', component: Transactions },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

new Vue({
    router,
}).$mount('#app');
