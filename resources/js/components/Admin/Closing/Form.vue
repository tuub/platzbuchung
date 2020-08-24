<template>
    <div>
        <h1>Closing Form</h1>
        <b-form>
            <b-form-group id="date_start-field" label="Date Start" label-for="date_start" class="font-weight-bold text-uppercase">
                <b-form-datepicker id="date_start" name="date_start" v-model="closing.date_start" close-button reset-button></b-form-datepicker>
            </b-form-group>
            <b-form-group id="date_end-field" label="Date End (optional)" label-for="date_end" class="font-weight-bold text-uppercase">
                <b-form-datepicker id="date_end" name="date_end" v-model="closing.date_end" close-button reset-button></b-form-datepicker>
            </b-form-group>
            <b-form-group id="description-field" label="Description" label-for="description" class="font-weight-bold text-uppercase">
                <b-form-input id="description" v-model="closing.description" type="text" autofocus required placeholder=""></b-form-input>
            </b-form-group>

            <b-button type="button" @click="storeClosing" class="text-uppercase" variant="success" :disabled="submitted" v-text="submitted ? 'Saving' : 'Save'"></b-button>
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
                closingId: this.$route.query.closing_id ?? 0,
                closing: [],
                submitted: false,
            }
        },
        methods: {
            fetchClosing: function () {
                axios.get('api/admin/location/closing/' + this.closingId).then((response) => {
                    this.closing = response.data;
                    this.form = this.closing;
                }).catch(error => {
                    console.log(error);
                });
            },
            storeClosing: function (e) {
                let action = this.closingId === 0 ? 'api/admin/location/closing/save' : 'api/admin/location/closing/' + this.closingId + '/update';
                let params = {
                    location_id: this.locationId,
                    date_start: this.closing.date_start,
                    date_end: this.closing.date_end,
                    description: this.closing.description,
                };

                axios.post(action, params).then((response) => {
                    this.$router.push({'name': 'admin_closing_index', query: { location_id: this.locationId }});
                }).catch(error => {
                    console.log(error);
                });
            },
        },
        mounted() {
            if (this.closingId > 0) {
                this.fetchClosing();
            }
        }
    }
</script>

<style scoped>

</style>
