require('./bootstrap');
import {createApp} from 'vue';
// import VueToast from 'vue-toast-notification';
window.Vue = createApp;
// import 'vue-toast-notification/dist/theme-sugar.css';
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router'
import {routes} from './router';

const router = new createRouter({
    history: createWebHistory(),
    routes: routes
});

const app = createApp(App).use(router)  
app.mount('#app');