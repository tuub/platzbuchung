<template>
    <div class="w-25 mx-auto">
        <h1>{{ $t('app.admin.resources.form.edit.title') }}</h1>
        <b-form>
            <b-form-group id="name-field" :label="$t('app.admin.resources.form.fields.name.label')" label-for="name" class="font-weight-bold text-uppercase">
                <b-form-input id="name" v-model="resource.name" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="short_name-field" :label="$t('app.admin.resources.form.fields.short_name.label')" label-for="short_name" class="font-weight-bold text-uppercase">
                <b-form-input id="short_name" v-model="resource.short_name" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="location_id-field" :label="$t('app.admin.resources.form.fields.location.label')" label-for="location_id" class="font-weight-bold text-uppercase">
                <b-form-select id="location_id" v-model="resource.location_id" :options="locationSelect"></b-form-select>
            </b-form-group>
            <b-form-group id="capacity-field" :label="$t('app.admin.resources.form.fields.capacity.label')" label-for="capacity" class="font-weight-bold text-uppercase">
                <b-form-input id="capacity" v-model="resource.capacity" type="text" required placeholder=""></b-form-input>
            </b-form-group>
            <b-form-group id="color-field" :label="$t('app.admin.resources.form.fields.color.label')" label-for="color" class="font-weight-bold text-uppercase">
                <b-form-input id="color" v-model="resource.color" type="text" required placeholder=""></b-form-input>
                <!--<colour-picker v-model="resource.color" :value="resource.color" picker="chrome" />-->
            </b-form-group>
            <b-form-group id="text_color-field" :label="$t('app.admin.resources.form.fields.text_color.label')" label-for="text_color" class="font-weight-bold text-uppercase">
                <b-form-input id="text_color" v-model="resource.text_color" type="text" required placeholder=""></b-form-input>
                <!--<colour-picker v-model="resource.text_color" :value="resource.text_color" picker="chrome" />-->
            </b-form-group>

            <b-button type="button" @click="storeResource" class="text-uppercase" variant="success" :disabled="submitted" v-text="submitted ?
                $t('app.admin.resources.form.submit_progress') :
                $t('app.admin.resources.form.submit_value')">
            </b-button>
            <b-button type="button" @click="closeForm" class="text-uppercase" variant="danger" :disabled="submitted" v-text="$t('app.admin.resources.form.cancel_value')"></b-button>
        </b-form>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: 'AdminResourceForm',
        data(){
            return {
                locationId: this.$route.query.location_id ?? 0,
                resourceId: this.$route.query.resource_id ?? 0,
                resource: {},
                locations: [],
                locationSelect: [],
                form: null,
                submitted: false,
            }
        },
        methods: {
            fetchResource: function () {
                axios.get('api/admin/resource/' + this.resourceId).then((response) => {
                    this.resource = response.data;
                    this.form = this.resource;
                }).catch(error => {
                    console.log(error);
                });
            },
            fetchLocations: function () {
                axios.get('api/admin/locations').then((response) => {
                    let vm = this;
                    vm.locationSelect.push({ value: null, text: 'Please choose' });
                    this.locations = response.data;
                    this.locations.forEach(function(location) {
                        vm.locationSelect.push({ value: location.id, text: location.name });
                    });
                    this.resource.location_id = this.locationId;
                }).catch(error => {
                    console.log(error);
                });
            },
            storeResource: function (e) {
                let action = this.resourceId === 0 ? 'api/admin/resource/save' : 'api/admin/resource/' + this.resourceId + '/update';
                let params = {};
                for(let element of e.target.form) {
                    if (element.id) {
                        params[element.id] = element.value;
                    }
                }

                axios.post(action, params).then((response) => {
                    this.$router.push({'name': 'admin_resource_index', query: { location_id: this.locationId } });
                }).catch(error => {
                    console.log(error);
                });
            },
            closeForm: function () {
                let dialog = this.$i18n.t('app.admin.resources.form.cancel_message');
                if (confirm(dialog)) {
                    this.$router.push({'name': 'admin_resource_index', query: { location_id: this.locationId }});
                };
            }
        },
        mounted() {
            this.fetchLocations();
            if (this.resourceId > 0) {
                this.fetchResource();
            }
        }
    }
</script>

<style scoped>

</style>
