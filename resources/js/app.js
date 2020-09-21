import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';

import router from "./_router";
import filters from './_filter';
import {store} from "./_store";

import moment from "./_plugins/moment";

import { BootstrapVue } from 'bootstrap-vue';

import VueAuth from '@websanova/vue-auth';
import authDriver from '@websanova/vue-auth/drivers/auth/bearer';
import httpDriver from '@websanova/vue-auth/drivers/http/axios.1.x';
import routerDriver from '@websanova/vue-auth/drivers/router/vue-router.2.x';

import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';

import App from "./components/App";



Vue.config.productionTip = false;
Vue.config.silent = true;

Object.keys(filters).forEach(key => Vue.filter(key, filters[key]));

Vue.use(VueAxios, axios);
Vue.use(BootstrapVue);
Vue.use(VueInternationalization);
Vue.router = router;

Vue.axios.defaults.headers.common['Accept'] = 'application/json';
Vue.axios.defaults.headers.common['Content-Type'] = 'application/json;charset=UTF-8';
Vue.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//Vue.axios.defaults.baseURL = document.head.querySelector('meta[name="api-base-url"]').content + '/api';



const lang = document.documentElement.lang.substr(0, 2);
const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
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
        enabled: false,
        interval: 30
    }
});

App.router = Vue.router;
App.store = store;
App.i18n = i18n;

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
    console.log('*** RESPONSE ERROR ***');

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
