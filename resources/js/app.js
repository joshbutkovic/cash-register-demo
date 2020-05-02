import './bootstrap';
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueCurrencyInput from 'vue-currency-input';
import Register from './Register';
import Reports from './Reports';
import Welcome from './Welcome';

window.Vue = Vue;

const pluginOptions = {
    globalOptions: { currency: 'USD' },
};

Vue.use(VueCurrencyInput, pluginOptions);
Vue.use(VueRouter);
Vue.component('main-menu', require('./MainMenu.vue').default);

const routes = [
    { path: '/', component: Welcome },
    { path: '/register', component: Register },
    { path: '/reports', component: Reports },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

new Vue({
    router,
}).$mount('#app');
