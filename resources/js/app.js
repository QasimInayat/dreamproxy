require('./bootstrap');
import { createApp } from 'vue';
import VueToast from 'vue-toast-notification';
window.Vue = createApp;
import 'vue-toast-notification/dist/theme-sugar.css';
import App from './App.vue';
import {createRouter, createWebHistory } from 'vue-router'
import { routes } from './router';

import Menu from './pages/components/Menu';
import Header from './pages/components/Header';
import Footer from './pages/components/Footer';
import auth from './middleware/auth';

const router = new createRouter({
    history: createWebHistory(),
    routes: routes
});



const app = createApp(App).use(router);
app.use(VueToast);
app.mount('#app');

app.component('app-menu', Menu);
app.component('app-header', Header);
app.component('app-footer', Footer); 

app.mixin({
    data() {
        return {

        }
    },
    mounted(){
        if(localStorage.getItem('email')){
            app.config.globalProperties.userName = localStorage.getItem('name');
            app.config.globalProperties.userEmail = localStorage.getItem('email');
        } else {
            app.config.globalProperties.userName = '';
            app.config.globalProperties.userEmail = '';
        }
    },
    methods: {
        openToastError(message) {
            this.$toast.open({
                message: message,
                type: "error",
                duration: 5000,
                dismissible: true,
                position: 'top-right'
            });
        },
        openToastSuccess(message) {
            this.$toast.open({
                message: message,
                type: "success",
                duration: 5000,
                dismissible: true,
                position: 'top-right'
            });
        }
    }
});


// Creates a `nextMiddleware()` function which not only
// runs the default `next()` callback but also triggers
// the subsequent Middleware function.
function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    // If no subsequent Middleware exists,
    // the default `next()` callback is returned.
    if (!subsequentMiddleware) return context.next;
  
    return (...parameters) => {
      // Run the default Vue Router `next()` callback first.
      context.next(...parameters);
      // Than run the subsequent Middleware with a new
      // `nextMiddleware()` callback.
      const nextMiddleware = nextFactory(context, middleware, index + 1);
      subsequentMiddleware({ ...context, next: nextMiddleware });
    };
  }
  
  router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
      const middleware = Array.isArray(to.meta.middleware)
        ? to.meta.middleware
        : [to.meta.middleware];
  
      const context = {
        from,
        next,
        router,
        to,
      };
      const nextMiddleware = nextFactory(context, middleware, 1);
  
      return middleware[0]({ ...context, next: nextMiddleware });
    }
  
    return next();
  })
