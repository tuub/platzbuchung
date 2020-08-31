<template>
    <div class="shadow">
        <b-navbar toggleable="lg" type="light" sticky="true" class="ml-3 mr-3">
            <b-navbar-brand tag="h1" class="mb-0" :to="{ name: 'locations' }">
                <img :src="logoFile" height="50" width="150" :title="this.$i18n.t('app.main.owner')" :alt="this.$i18n.t('app.main.owner')" />
            </b-navbar-brand>

            <b-navbar-text>
                <h1 class="h4">{{ $t('app.main.title') }}</h1>
            </b-navbar-text>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">

                    <b-nav-item exact="true" :to="{ name: 'locations' }" class="bg-white">
                        {{ $t('app.locations.title') }}
                    </b-nav-item>

                    <b-nav-item v-if="location" exact="true" :to="{ name: 'home', params: { location: location.uid } }" class="bg-white">
                        {{ location.name }}: {{ $t('app.home.title') }}
                    </b-nav-item>

                    <b-nav-item exact="true" :to="{ name: 'bookings' }" class="bg-white" v-if="isLoggedIn">
                        {{ $t('app.bookings.title') }}
                    </b-nav-item>

                    <b-nav-item exact="true" :to="{ name: 'profile' }" class="bg-white" v-if="isLoggedIn">
                        {{ $t('app.profile.title') }}
                    </b-nav-item>

                    <b-nav-item exact="true" :to="{ name: 'login' }" class="bg-white" v-if="!isLoggedIn">
                        {{ $t('app.login.title') }}
                    </b-nav-item>

                    <b-nav-item class="bg-white" v-if="isLoggedIn" @click.prevent="handleLogout">
                        {{ $t('app.logout.title') }}
                    </b-nav-item>

                    <b-nav-text class="ml-sm-0 ml-3 bg-dark text-white px-2" v-if="isLoggedIn">
                        <b-avatar variant="dark" size="sm"></b-avatar>
                        <span class="mr-auto font-weight-bold small"> {{ userName }}</span>
                        <b-badge class="ml-1">{{ userBookings.length }}</b-badge>
                    </b-nav-text>
                    <!--
                    <b-nav-item-dropdown text="Lang" right>
                        <b-dropdown-item href="#">EN</b-dropdown-item>
                        <b-dropdown-item href="#">ES</b-dropdown-item>
                        <b-dropdown-item href="#">RU</b-dropdown-item>
                        <b-dropdown-item href="#">FA</b-dropdown-item>
                    </b-nav-item-dropdown>

                    <b-nav-item-dropdown right>
                        <template v-slot:button-content>
                            <em>User</em>
                        </template>
                        <b-dropdown-item href="#">Profile</b-dropdown-item>
                        <b-dropdown-item href="#">Sign Out</b-dropdown-item>
                    </b-nav-item-dropdown>
                    -->
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
    import LangSwitcher from "./LangSwitcher";
    import {store} from "../_store";

    export default {
        name: "Header",
        components: {
            LangSwitcher
        },
        data() {
            return {
                logoFile: process.env.MIX_APP_LOGO,
            }
        },
        watch: {
            location (newLocation, oldLocation) {
                //console.log(oldLocation);
                //console.log(newLocation);
            }
        },
        computed: {
            location() {
                return store.state.LOCATION ?? null;
            },
            isLoggedIn() {
                return store.state.STATUS.isLoggedIn || false;
            },
            isAdmin() {
                return true;
            },
            userName() {
                return this.isLoggedIn && store.state.USER ? store.state.USER.barcode : 'NOBODY';
            },
            userBookings() {
                return this.isLoggedIn && store.state.BOOKINGS ? store.state.BOOKINGS : 0;
            },
        },
        methods: {
            handleLogout (e) {
                let app = this;
                store.dispatch('LOGOUT_REQUEST');
                this.$auth.logout({
                    success: function (response) {
                        store.dispatch('LOGOUT_SUCCESS', {response: response.data, message: app.$i18n.t('app.logout.status.logout_success')});
                    },
                    error: function (error) {
                        store.dispatch('LOGOUT_FAILURE', {response: error, message: app.$i18n.t('app.logout.status.logout_failure')});
                    },
                });

                this.$router.push({name: 'home', params: { location: this.location } }, () => {});
            }
        }
    }
</script>

<style scoped>

</style>
