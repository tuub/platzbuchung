<template>
    <div>
        <h1>Location Form</h1>
        <b-form>
            <b-form-group id="uid-field" label="UID" label-for="uid" class="font-weight-bold text-uppercase">
                <b-form-input id="uid" v-model="location.uid" type="text" autofocus required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="name-field" label="Name" label-for="name" class="font-weight-bold text-uppercase">
                <b-form-input id="name" v-model="location.name" type="text" autofocus required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="address-field" label="Address" label-for="address" class="font-weight-bold text-uppercase">
                <b-form-input id="address" v-model="location.address" type="text" autofocus required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="email-field" label="Email" label-for="email" class="font-weight-bold text-uppercase">
                <b-form-input id="email" v-model="location.email" type="text" autofocus required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="logo_uri-field" label="Logo URI" label-for="logo_uri" class="font-weight-bold text-uppercase">
                <b-form-input id="logo_uri" v-model="location.logo_uri" type="text" autofocus required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="image_uri-field" label="Image URI" label-for="image_uri" class="font-weight-bold text-uppercase">
                <b-form-input id="image_uri" v-model="location.image_uri" type="text" autofocus required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="latitude-field" label="Latitude" label-for="latitude" class="font-weight-bold text-uppercase">
                <b-form-input id="latitude" v-model="location.latitude" type="text" autofocus required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="longitude-field" label="Longitude" label-for="longitude" class="font-weight-bold text-uppercase">
                <b-form-input id="longitude" v-model="location.longitude" type="text" autofocus required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="display_days_in_advance-field" label="Display Days In Advance" label-for="display_days_in_advance" class="font-weight-bold text-uppercase">
                <b-form-input id="display_days_in_advance" v-model="location.display_days_in_advance" type="text" autofocus required placeholder=""></b-form-input>
                <b-form-input id="display_days_in_advance" v-model="location.display_days_in_advance" type="range" min="0" max="30"></b-form-input>
            </b-form-group>
            <b-form-group id="user_booking_quota" label="User Booking Quota" label-for="user_booking_quota" class="font-weight-bold text-uppercase">
                <b-form-input id="user_booking_quota" v-model="location.user_booking_quota" type="text" autofocus required placeholder=""></b-form-input>
                <b-form-input id="user_booking_quota" v-model="location.user_booking_quota" type="range" min="0" max="10"></b-form-input>
            </b-form-group>

            <b-button type="button" @click="storeLocation" class="text-uppercase" variant="success" :disabled="submitted" v-text="submitted ? 'Saving' : 'Save'"></b-button>
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
                let params = {};
                for(let element of e.target.form) {
                    if (element.id) {
                        params[element.id] = element.value;
                    }
                }

                axios.post(action, params).then((response) => {
                    this.$router.push({'name': 'admin_location_index'});
                }).catch(error => {
                    console.log(error);
                });
            },
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
