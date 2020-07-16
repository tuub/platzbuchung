<template>
    <div class="text-center w-25 mx-auto">
        <h1>{{ $t('app.login.title') }}</h1>
        <p class="lead">{{ $t('app.login.intro') }}</p>
        <b-form>
            <b-form-group id="username-field" :label="usernameLabel" label-for="username" class="font-weight-bold text-uppercase">
                <b-form-input id="username" v-model="username" type="text" autofocus required placeholder=""></b-form-input>
                <div class="mt-2">
                    <div class="small text-left" v-for="usernameHint in usernameHints">
                        {{ usernameHint }}
                    </div>
                </div>
            </b-form-group>

            <b-form-group id="password-field" :label="passwordLabel" label-for="password" class="font-weight-bold text-uppercase">
                <b-form-input id="password" v-model="password" type="password" required placeholder=""></b-form-input>
                <div class="mt-2">
                    <div class="small text-left" v-for="passwordHint in passwordHints">
                        {{ passwordHint }}
                    </div>
                </div>
            </b-form-group>
            <b-button type="button" @click="handleSubmit" class="text-uppercase" variant="success" :disabled="submitted" v-text="submitted ? $t('app.login.form.login.submit_progress_value') : $t('app.login.form.login.submit_value')">Submit</b-button>
        </b-form>
    </div>
</template>

<script>
    import {store} from "../_store";

    export default {
        name: 'LoginForm',
        data () {
            return {
                errors: [],
                usernameLabel: this.$i18n.t('app.login.form.login.username.label'),
                usernameHints: [
                    this.$i18n.t('app.login.form.login.username.hint_tu'),
                    this.$i18n.t('app.login.form.login.username.hint_udk'),
                ],
                username: '',
                passwordLabel: this.$i18n.t('app.login.form.login.password.label'),
                passwordHints: [
                    this.$i18n.t('app.login.form.login.password.hint_tu'),
                    this.$i18n.t('app.login.form.login.password.hint_udk'),
                ],
                password: '',
                submitted: false
            }
        },
        methods: {
            savePhone(value) {
                let payload = { phone: value };
                return this.axios.post('api/user/save_phone', payload).then((response) => {
                    return response;
                }).catch(error => {
                    let errorMessage = ''; //error.response.data.message;
                    let validationMessages = Object.values(error.response.data.errors).flat();
                    errorMessage += validationMessages.join('<br/>');
                    this.$swal.showValidationMessage(errorMessage);
                })
            },

            handleSubmit (e) {
                this.submitted = true;
                const { username, password } = this;
                if (username && password) {
                    let app = this;
                    store.dispatch('LOGIN_REQUEST');
                    this.$auth.login({
                        params: {
                            username: username,
                            password: password
                        },
                        success: function (response) {
                            if (app.$auth.ready()) {
                                store.dispatch('FETCH_USER_REQUEST');
                                app.$auth.fetch().then((response) => {
                                    let userData = response ? app.$auth.user(response.data) : null;
                                    if (userData) {
                                        store.dispatch('FETCH_USER_SUCCESS', userData).then(() => {
                                            store.dispatch('FETCH_USER_BOOKINGS').then(() => {
                                                if (!store.state.USER.phone) {
                                                    //const phoneAlert = alertService.alertPhone();
                                                    const phoneAlert = app.$swal({
                                                        icon: 'info',
                                                        title: app.$i18n.t('app.phone.form.create.title'),
                                                        html: app.$i18n.t('app.phone.form.create.text'),
                                                        input: 'text',
                                                        inputValue: '',
                                                        inputAttributes: {
                                                            name: 'phone',
                                                        },
                                                        showCancelButton: true,
                                                        confirmButtonText: app.$i18n.t('app.phone.form.create.submit_value'),
                                                        cancelButtonText: app.$i18n.t('app.phone.form.create.cancel_value'),
                                                        preConfirm: app.savePhone,
                                                    });
                                                    phoneAlert.then((response) => {
                                                        app.submitted = false;
                                                        if (response.isConfirmed) {
                                                            let responseData = JSON.parse(response.value.config.data);
                                                            store.dispatch('SAVE_USER_PHONE', {phone: responseData.phone});
                                                            store.dispatch('LOGIN_SUCCESS', {response: response, message: app.$i18n.t('app.login.status.login_success')});
                                                            app.$router.push({name: 'home'});
                                                        } else {
                                                            store.dispatch('LOGOUT_SUCCESS', {response: response, message: app.$i18n.t('app.logout.status.logout_no_phone')});
                                                        }
                                                    })
                                                } else {
                                                    app.submitted = false;
                                                    store.dispatch('LOGIN_SUCCESS', {response: response, message: app.$i18n.t('app.login.status.login_success')});
                                                    app.$router.push({name: 'home'});
                                                }
                                            });
                                        });
                                    }
                                });
                            }
                        },
                        error: function (response) {
                            app.submitted = false;
                        },
                    }).then((response) => {

                    }).catch(error => {
                        console.log(error);
                    });
                }
            }
        }
    };
</script>
