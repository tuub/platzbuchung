import Vue from 'vue';
import VueRouter from 'vue-router';
import moment from 'moment-timezone';
import axios from 'axios';
import VueAxios from 'vue-axios';

import { BootstrapVue } from 'bootstrap-vue';

import VueAuth from '@websanova/vue-auth';
import authDriver from '@websanova/vue-auth/drivers/auth/bearer';
import httpDriver from '@websanova/vue-auth/drivers/http/axios.1.x';
import routerDriver from '@websanova/vue-auth/drivers/router/vue-router.2.x';

import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';

import App from "./components/App";
import Home from "./components/Home";
import LoginForm from "./components/LoginForm";
import Bookings from "./components/Bookings";
import Profile from "./components/Profile";

import {store} from "./_store";

Vue.config.productionTip = false;
Vue.config.silent = true;

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(BootstrapVue);
Vue.use(VueInternationalization);

Vue.axios.defaults.headers.common['Accept'] = 'application/json';
Vue.axios.defaults.headers.common['Content-Type'] = 'application/json;charset=UTF-8';
Vue.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//Vue.axios.defaults.baseURL = document.head.querySelector('meta[name="api-base-url"]').content + '/api';

moment.locale("de-DE");
moment.tz.setDefault('Europe/Berlin');

const lang = document.documentElement.lang.substr(0, 2);
const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

const router = new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                guest: true
            }
        },
        {
            path: '/login',
            name: 'login',
            component: LoginForm,
            meta: {
                guest: true
            }
        },
        {
            path: '/bookings',
            name: 'bookings',
            component: Bookings,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            meta: {
                requiresAuth: true,
            }
        },
    ]
});

Vue.router = router;

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(value).format('dd, DD.MM.YYYY');
    }
});

Vue.filter('formatTime', function(value) {
    if (value) {
        return moment(value).format('H:mm');
    }
});

Vue.use(VueAuth, {
    auth: authDriver,
    http: httpDriver,
    router: routerDriver,
    loginData: {
        url: 'api/auth/login',
        redirect: null,
        fetchUser: false,
        staySignedIn: false,
        rememberMe: true,
    },
    logoutData: {
        url: 'api/auth/logout',
        makeRequest: true,
    },
    fetchData: {
        url: 'api/auth/me',
        redirect: null,
        method: 'POST',
    },
    refreshData: {
        url: 'api/auth/refresh',
        method: 'POST',
        enabled: true,
        interval: 30
    }
});

App.router = Vue.router;
App.store = store;
App.i18n = i18n;

/*
App.data = {
    alert: { type: null, message: null },
    loading: false,
    error: false,
    errors: {},
};
*/

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (Vue.prototype.$auth.check()) {
            next();
        } else {
            store.dispatch('LOGOUT_ACTION');
            next({name: 'login'});
            return;
        }
    }
    next();
});


/*
App.methods = {
    closeErrors() {
        this.error = false;
        this.errors = {};
    },
    getAlert(data) {
        this.$swal('Hello Vue world!!!');
    },
    handleLogout(e) {
        console.log('handled logout');
    }
};
*/

const vueApp = new Vue(App).$mount('#app');

/*
const app = new Vue({
    el: '#app',
    //router,
    store,
    //mounted() {}
    render: h => h(App)
});
*/

Vue.axios.interceptors.request.use(config => {
    //console.log('*** REQUEST CONFIG ***');
    //console.log(config);
    vueApp.loading = true;
    return config;
});

Vue.axios.interceptors.response.use(function (response) {
    //console.log('*** RESPONSE OK ***');
    //console.log(response);
    return response;
}, function (error) {
    //console.log('*** RESPONSE ERROR ***');

    // Authentication error
    if (401 === error.response.status) {
        let errorMessage = error.response.data.error;
        let payload = {
            message: App.i18n.t('app.auth.status.auth_failure', {error_message: errorMessage ? errorMessage : App.i18n.t('app.auth.status.session_expired')}),
        };
        store.dispatch('ALERT_FAILURE', payload.message);
        store.state.STATUS.isLoggedIn = false;
        if (router.currentRoute.name !== 'login') {
            router.push({name: 'login'});
        }
    }

    // Validation error
    if (422 === error.response.status) {
        //
    }

    return Promise.reject(error);
});
