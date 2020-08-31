import Vue from 'vue';
import VueRouter, { RouteConfig } from 'vue-router';

import Home from "./../components/Home";
import Locations from "./../components/Locations";
import LoginForm from "./../components/LoginForm";
import Bookings from "./../components/Bookings";
import Profile from "./../components/Profile";

import AdminLocationIndex from './../components/Admin/Location/Index';
import AdminLocationForm from './../components/Admin/Location/Form';
import AdminClosingIndex from './../components/Admin/Closing/Index';
import AdminClosingForm from './../components/Admin/Closing/Form';
import AdminResourceIndex from './../components/Admin/Resource/Index';
import AdminResourceForm from './../components/Admin/Resource/Form';
import AdminTimeSlotIndex from './../components/Admin/TimeSlot/Index';
import AdminTimeSlotForm from './../components/Admin/TimeSlot/Form';
import {store} from "../_store";
import axios from "axios";

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'locations',
        component: Locations,
        meta: {
            guest: true
        }
    },
    {
        path: '/home/:location',
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
    {
        path: '/admin/locations',
        name: 'admin_location_index',
        component: AdminLocationIndex,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
        }
    },
    {
        path: '/admin/location/form',
        name: 'admin_location_form',
        component: AdminLocationForm,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
        }
    },
    {
        path: '/admin/closing/index',
        name: 'admin_closing_index',
        component: AdminClosingIndex,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
        }
    },
    {
        path: '/admin/closing/form',
        name: 'admin_closing_form',
        component: AdminClosingForm,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
        }
    },
    {
        path: '/admin/resources',
        name: 'admin_resource_index',
        component: AdminResourceIndex,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
        }
    },
    {
        path: '/admin/resource/form',
        name: 'admin_resource_form',
        component: AdminResourceForm,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
        }
    },
    {
        path: '/admin/time_slots',
        name: 'admin_time_slot_index',
        component: AdminTimeSlotIndex,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
        }
    },
    {
        path: '/admin/time_slot/form',
        name: 'admin_time_slot_form',
        component: AdminTimeSlotForm,
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
        }
    },
];

const router = new VueRouter({
    mode: 'hash',
    base: process.env.APP_URL,
    routes,
});

function checkAdminRights() {
    axios.get('api/user/permissions', { username: store.getters.user.username }).then((response) => {
        console.log(response.data);
        next();
    }).catch(error => {
        //commit('fetchUserBookingsFailure', error);
        //dispatch('TOAST_FAILURE', error);
        //reject(error);
    });
    /*
    store.dispatch('CHECK_USER_STATUS', store.getters.user.username).then((response) => {
        console.log('Admin?');
        console.log(response);
        return response;
    });
     */
}

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (Vue.prototype.$auth.check()) {
            if(to.matched.some(record => record.meta.requiresAdmin)) {
                let username = store.getters.user.username;
                axios.get('api/user/permissions', { username: username }).then((response) => {
                    if (Boolean(response.data) === true) {
                        next();
                    } else {
                        next('/');
                    }
                }).catch(error => {
                    console.log(error);
                });
            } else {
                next();
            }
        } else {
            store.dispatch('LOGOUT_ACTION');
            next({name: 'login', query: {redirect: to.fullPath}});
            return;
        }
    }
    next();
});

export default router;
