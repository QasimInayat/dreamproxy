require('./bootstrap');
import {createApp} from 'vue';
// import VueToast from 'vue-toast-notification';
window.Vue = createApp;
// import 'vue-toast-notification/dist/theme-sugar.css';
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router'
import {routes} from './router';

import Menu from './pages/components/Menu';
import Header from './pages/components/Header';
import Footer from './pages/components/Footer';

const router = new createRouter({
    history: createWebHistory(),
    routes: routes
});

const app = createApp(App).use(router)  
app.mount('#app');

app.component('app-menu', Menu);
app.component('app-header', Header);
app.component('app-footer', Footer);