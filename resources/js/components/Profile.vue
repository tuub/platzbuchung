<template>
    <div class="text-center mx-auto col-12 col-md-4">
        <h1>{{ $t('app.profile.title') }}</h1>
        <p class="lead">{{ $t('app.profile.intro') }}</p>
        <b-form>
            <b-form-group id="username-field" :label="usernameLabel" label-for="username" class="font-weight-bold text-uppercase">
                <b-form-input id="username" v-model="userName" type="text" disabled autofocus required placeholder=""></b-form-input>
            </b-form-group>

            <b-form-group id="phone-field" :label="phoneLabel" label-for="phone" class="font-weight-bold text-uppercase">
                <b-input-group
                    :size="lg"
                    class="mb-3">
                    <b-form-input id="phone" v-model="userPhone" type="text" disabled required placeholder=""></b-form-input>
                    <b-input-group-append>
                        <b-button type="button" @click="editPhone" class="text-uppercase" variant="success">{{ $t('app.profile.action.edit_phone') }}</b-button>
                    </b-input-group-append>
                </b-input-group>

            </b-form-group>
        </b-form>
        </div>
</template>

<script>
    import {store} from "../_store";
    import { alertService } from "../_services";
    import Vue from "vue";

    export default {
        name: "Profile",
        data() {
            return {
                usernameLabel: this.$i18n.t('app.profile.label.username'),
                phoneLabel: this.$i18n.t('app.profile.label.phone'),
            }
        },
        computed: {
            userName: function () {
                return store.state.USER.barcode;
            },
            userPhone: function () {
                return store.state.USER.phone;
            },
        },
        methods: {
            savePhone(value) {
                let payload = { phone: value };
                return this.axios.post('api/user/save_phone', payload).then((response) => {
                    store.dispatch('SAVE_USER_PHONE', {phone: payload.phone, message: this.$i18n.t('app.phone.status.edit_success')});
                }).catch(error => {
                    let errorMessage = ''; //error.response.data.message;
                    let validationMessages = Object.values(error.response.data.errors).flat();
                    errorMessage += validationMessages.join('<br/>');
                    this.$swal.showValidationMessage(errorMessage);
                })
            },
            editPhone: function () {
                let current_phone = this.userPhone;
                //const phoneAlert = alertService.alertPhone();
                const phoneAlert = this.$swal({
                    icon: 'info',
                    title: this.$i18n.t('app.phone.form.edit.title'),
                    html: this.$i18n.t('app.phone.form.edit.text'),
                    input: 'text',
                    inputValue: current_phone,
                    inputAttributes: {
                        name: 'phone',
                    },
                    showCancelButton: true,
                    confirmButtonText: this.$i18n.t('app.phone.form.edit.submit_value'),
                    cancelButtonText: this.$i18n.t('app.phone.form.edit.cancel_value'),
                    preConfirm: this.savePhone,
                });
            }
        }
    }
</script>

<style scoped>

</style>
