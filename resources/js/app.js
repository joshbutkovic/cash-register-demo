import VueRouter from 'vue-router';

import Register from './Register';
import Reports from './Reports';
import Welcome from './Welcome';

require('./bootstrap');
window.Vue = require('vue');

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
