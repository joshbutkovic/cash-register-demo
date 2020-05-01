import ExampleComponent from './components/ExampleComponent';

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            component: ExampleComponent,
            name: 'Example',
        },
    ],
};
