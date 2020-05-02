import Welcome from '../Welcome.vue';

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'welcome',
            component: Welcome,
        },
    ],
};
