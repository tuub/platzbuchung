<template>
    <div class="w-50 mx-auto">
        <h1>{{ $t('app.admin.locations.form.edit.title') }}</h1>
        <b-form>
            <b-form-group id="uid-field" :label="$t('app.admin.locations.form.fields.uid.label')" label-for="uid" class="font-weight-bold text-uppercase">
                <b-form-input id="uid" v-model="location.uid" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="name-field" :label="$t('app.admin.locations.form.fields.name.label')" label-for="name" class="font-weight-bold text-uppercase">
                <b-form-input id="name" v-model="location.name" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="address-field" :label="$t('app.admin.locations.form.fields.address.label')" label-for="address" class="font-weight-bold text-uppercase">
                <b-form-input id="address" v-model="location.address" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="email-field" :label="$t('app.admin.locations.form.fields.email.label')" label-for="email" class="font-weight-bold text-uppercase">
                <b-form-input id="email" v-model="location.email" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="logo_uri-field" :label="$t('app.admin.locations.form.fields.logo_uri.label')" label-for="logo_uri" class="font-weight-bold text-uppercase">
                <b-form-input id="logo_uri" v-model="location.logo_uri" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="image_uri-field" :label="$t('app.admin.locations.form.fields.image_uri.label')" label-for="image_uri" class="font-weight-bold text-uppercase">
                <b-form-input id="image_uri" v-model="location.image_uri" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="latitude-field" :label="$t('app.admin.locations.form.fields.latitude.label')" label-for="latitude" class="font-weight-bold text-uppercase">
                <b-form-input id="latitude" v-model="location.latitude" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="longitude-field" :label="$t('app.admin.locations.form.fields.longitude.label')" label-for="longitude" class="font-weight-bold text-uppercase">
                <b-form-input id="longitude" v-model="location.longitude" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="display_days_in_advance-field" :label="$t('app.admin.locations.form.fields.display_days_in_advance.label')" label-for="display_days_in_advance" class="font-weight-bold text-uppercase">
                <b-form-input id="display_days_in_advance" v-model="location.display_days_in_advance" type="text" required placeholder=""></b-form-input>
                <b-form-input id="display_days_in_advance" v-model="location.display_days_in_advance" type="range" min="0" max="30"></b-form-input>
            </b-form-group>
            <b-form-group id="user_booking_quota-field" :label="$t('app.admin.locations.form.fields.user_booking_quota.label')" label-for="user_booking_quota" class="font-weight-bold text-uppercase">
                <b-form-input id="user_booking_quota" v-model="location.user_booking_quota" type="text" required placeholder=""></b-form-input>
                <b-form-input id="user_booking_quota" v-model="location.user_booking_quota" type="range" min="0" max="10"></b-form-input>
            </b-form-group>
            <b-form-group id="allowed_minutes_for_pre_check_in-field" :label="$t('app.admin.locations.form.fields.allowed_minutes_for_pre_check_in.label')" label-for="allowed_minutes_for_pre_check_in" class="font-weight-bold text-uppercase">
                <b-form-input id="allowed_minutes_for_pre_check_in" v-model="location.allowed_minutes_for_pre_check_in" type="text" required placeholder=""></b-form-input>
                <b-form-input id="allowed_minutes_for_pre_check_in" v-model="location.allowed_minutes_for_pre_check_in" type="range" min="0" max="60"></b-form-input>
            </b-form-group>
            <b-form-group id="is_pre_check_in_displayed-field" :label="$t('app.admin.locations.form.fields.is_pre_check_in_displayed.label')" label-for="is_pre_check_in_displayed" class="font-weight-bold text-uppercase">
                <b-form-checkbox id="is_pre_check_in_displayed" v-model="location.is_pre_check_in_displayed" name="is_pre_check_in_displayed" value="1" unchecked-value="0">
                    {{ $t('app.admin.locations.form.fields.is_pre_check_in_displayed.value') }}
                </b-form-checkbox>
            </b-form-group>
            <b-form-group id="seconds_until_check_in_refresh-field" :label="$t('app.admin.locations.form.fields.seconds_until_check_in_refresh.label')" label-for="seconds_until_check_in_refresh" class="font-weight-bold text-uppercase">
                <b-form-input id="seconds_until_check_in_refresh" v-model="location.seconds_until_check_in_refresh" type="text" required placeholder=""></b-form-input>
                <b-form-input id="seconds_until_check_in_refresh" v-model="location.seconds_until_check_in_refresh" type="range" min="0" max="10"></b-form-input>
            </b-form-group>
            <b-form-group id="seconds_until_check_out_refresh-field" :label="$t('app.admin.locations.form.fields.seconds_until_check_out_refresh.label')" label-for="seconds_until_check_out_refresh" class="font-weight-bold text-uppercase">
                <b-form-input id="seconds_until_check_out_refresh" v-model="location.seconds_until_check_out_refresh" type="text" required placeholder=""></b-form-input>
                <b-form-input id="seconds_until_check_out_refresh" v-model="location.sseconds_until_check_out_refresh" type="range" min="0" max="10"></b-form-input>
            </b-form-group>
            <b-button type="button" @click="storeLocation" class="text-uppercase" variant="success" :disabled="submitted" v-text="submitted ?
                $t('app.admin.locations.form.submit_progress') :
                $t('app.admin.locations.form.submit_value')">
            </b-button>
            <b-button type="button" @click="closeForm" class="text-uppercase" variant="danger" :disabled="submitted" v-text="$t('app.admin.locations.form.cancel_value')"></b-button>
        </b-form>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: 'AdminLocationForm',
        data(){
            return {
                locationId: this.$route.query.location_id ?? 0,
                location: {},
                form: location,
                submitted: false,
            }
        },
        methods: {
            fetchLocation: function () {
                axios.get('api/admin/location/' + this.locationId).then((response) => {
                    this.location = response.data;
                    this.form = this.location;
                }).catch(error => {
                    console.log(error);
                });
            },
            storeLocation: function (e) {
                let action = this.locationId === 0 ? 'api/admin/location/save' : 'api/admin/location/' + this.locationId + '/update';
                /*
                let params = {};
                for(let element of e.target.form) {
                    if (element.id) {
                        params[element.id] = element.value;
                    }
                }
                 */

                //console.log(this.location);

                axios.post(action, this.location).then((response) => {
                    this.$router.push({'name': 'admin_location_index'});
                }).catch(error => {
                    console.log(error);
                });
            },
            closeForm: function () {
                let dialog = this.$i18n.t('app.admin.locations.form.cancel_message');
                if (confirm(dialog)) {
                    this.$router.push({'name': 'admin_location_index'});
                };
            }
        },
        mounted() {
            if (this.locationId > 0) {
                this.fetchLocation();
            }
        }
    }
</script>

<style scoped>

</style>
