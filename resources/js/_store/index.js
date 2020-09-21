import Vue from 'vue';
import Vuex from 'vuex';
import VueSweetalert2 from 'vue-sweetalert2';
import createPersistedState from "vuex-persistedstate";
import axios from "axios";

Vue.use(VueSweetalert2);
Vue.use(Vuex);

const vuexData = JSON.parse(localStorage.getItem(process.env.MIX_APP_URL));

let alert = new Vue();

const Toast = alert.$swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', alert.$swal.stopTimer);
        toast.addEventListener('mouseleave', alert.$swal.resumeTimer);
    }
});

const initialState = {
    USER: vuexData ? vuexData.USER : null,
    BOOKINGS: null,
    STATUS: {
        loggingIn: false,
        isLoggedIn: vuexData ? vuexData.STATUS.isLoggedIn : false,
        fetchingUser: false,
        fetchedUser: false,
        savingPhone: false,
        fetchingUserBookings: false,
    }
};

const actions = {
    /*
    |--------------------------------------------------------------------------
    | ALERTS, DIALOGS AND TOASTS
    |--------------------------------------------------------------------------
    */
    ALERT_SUCCESS({commit}, message) {
        alert.$swal({
            icon: 'success',
            text: message,
            confirmButtonText: 'OK',
        });
    },
    ALERT_FAILURE({commit}, message) {
        alert.$swal({
            icon: 'error',
            text: message,
            footer: '<a href="mailto:' + process.env.MIX_SUPPORT_EMAIL + '">Contact support</a>'
        });
    },
    ALERT_CLEAR({commit}) {
        commit('alertClear');
    },
    TOAST_SUCCESS({commit}, message) {
        Toast.fire({
            icon: 'success',
            title: message,
        })
    },
    TOAST_FAILURE({commit}, message) {
        Toast.fire({
            icon: 'error',
            title: message,
        })
    },
    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATION
    |--------------------------------------------------------------------------
    */
    LOGIN_REQUEST({commit}) {
        commit('loginRequest');
    },
    LOGIN_SUCCESS({commit, dispatch}, payload) {
        commit('loginSuccess', payload.response);
        dispatch('TOAST_SUCCESS', payload.message);
    },
    LOGIN_FAILURE({commit, dispatch}, payload) {
        commit('loginFailure');
        dispatch('TOAST_SUCCESS', payload.message);
    },
    FETCH_USER_REQUEST({commit}) {
        commit('fetchUserRequest');
    },
    FETCH_USER_SUCCESS({commit}, payload) {
        commit('fetchUserSuccess', payload);
    },
    FETCH_USER_FAILURE({commit}) {
        commit('fetchUserFailure');
    },
    LOGOUT_REQUEST({commit}) {
        commit('logoutRequest');
    },
    LOGOUT_SUCCESS({commit, dispatch}, payload) {
        commit('logoutSuccess');
        dispatch('TOAST_SUCCESS', payload.message);
    },
    LOGOUT_FAILURE({commit, dispatch}, payload) {
        commit('logoutFailure');
    },
    LOGOUT_ACTION({commit, dispatch}) {
        commit('logout');
    },
    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */
    SAVE_USER_PHONE({commit, dispatch}, payload) {
        commit('saveUserPhone', payload.phone);
    },
    FETCH_USER_BOOKINGS({commit, dispatch}) {
        commit('fetchUserBookingsRequest');
        axios.get('api/user/bookings').then((response) => {
            let bookings = response.data;
            commit('fetchUserBookingsSuccess', bookings);
        }).catch(error => {
            commit('fetchUserBookingsFailure', error);
            dispatch('TOAST_FAILURE', error);
            // reject(error);
        });
    },
    /*
    |--------------------------------------------------------------------------
    | LOCATION
    |--------------------------------------------------------------------------
    */
    SAVE_LOCATION({commit, dispatch}, payload) {
        axios.get('api/location/' +  payload.location).then((response) => {
            commit('saveLocation', response.data);
        }).catch(error => {
            console.log(error);
            // reject(error);
        });
    }
};

const mutations = {
    loginRequest(state) {
        state.STATUS.loggingIn = true;
    },
    loginSuccess(state) {
        state.STATUS.loggingIn = false;
        state.STATUS.isLoggedIn = true;
    },
    loginFailure(state) {
        state.STATUS.loggingIn = false;
        state.STATUS.isLoggedIn = false;
    },
    logoutRequest(state) {
        //
    },
    logoutSuccess(state) {
        state.STATUS.isLoggedIn = false;
        state.USER = null;
        state.BOOKINGS = null;
    },
    logoutFailure(state) {
        localStorage.clear();
        state.STATUS.isLoggedIn = false;
    },
    logout(state) {
        state.STATUS.isLoggedIn = false;
        state.USER = null;
        state.BOOKINGS = null;
    },
    fetchUserRequest(state) {
        state.STATUS.fetchingUser = true;
    },
    fetchUserSuccess(state, user) {
        state.STATUS.fetchingUser = false;
        state.STATUS.fetchedUser = true;
        state.USER = user;
    },
    fetchUserFailure(state) {
        state.STATUS.fetchingUser = false;
        state.USER = null;
    },
    fetchUserBookingsRequest(state) {
        state.STATUS.fetchingUserBookings = true;
    },
    fetchUserBookingsSuccess(state, bookings) {
        state.BOOKINGS = bookings;
        state.STATUS.fetchingUserBookings = false;
    },
    fetchUserBookingsFailure(state, bookings) {
        state.BOOKINGS = null;
        state.STATUS.fetchingUserBookings = false;
    },
    saveUserPhone(state, phone) {
        state.USER.phone = phone;
    },
    saveLocation(state, location) {
        state.LOCATION = location;
    }
};

const getters = {
    user: state => state.USER,
    isLoggedIn: state => state.STATUS.isLoggedIn,
};

export const store = new Vuex.Store({
    state: initialState,
    actions: actions,
    mutations: mutations,
    getters: getters,
    plugins: [createPersistedState({
        key: process.env.MIX_APP_URL,
    })]
});
