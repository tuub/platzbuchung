<template>
    <div>
        <b-button :to="{ name: 'admin_location_form' }">New Location</b-button>
        <b-table-simple class="w-100 mx-auto" hover caption-top responsive>
            <b-thead head-variant="dark">
                <b-tr>
                    <b-th>UID</b-th>
                    <b-th>Name</b-th>
                    <b-th>Address</b-th>
                    <b-th>Email</b-th>
                    <b-th>Logo</b-th>
                    <b-th>Image</b-th>
                    <b-th>Coordinates</b-th>
                    <b-th>Days in advance</b-th>
                    <b-th>User booking quota</b-th>
                    <b-th>Actions</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for="location in locations" :key="location.id">
                    <b-td>{{ location.uid }}</b-td>
                    <b-td>{{ location.name }}</b-td>
                    <b-td>{{ location.address }}</b-td>
                    <b-td>{{ location.email }}</b-td>
                    <b-td><span v-html="$options.filters.formatImageUri(location.logo_uri, 125, y)"></span></b-td>
                    <b-td><span v-html="$options.filters.formatImageUri(location.image_uri, 125, y)"></span></b-td>
                    <b-td>{{ location.latitude }},{{ location.longitude }}</b-td>
                    <b-td>{{ location.display_days_in_advance }}</b-td>
                    <b-td>{{ location.user_booking_quota }}</b-td>
                    <b-td>
                        <b-button class="btn-block d-block" size="sm" :to="{ name: 'admin_location_form', query: { location_id: location.id } }">Edit</b-button>
                        <b-button class="btn-block d-block" size="sm" @click="deleteLocation(location.id)">Delete</b-button>
                        <b-button class="btn-block d-block" size="sm" :to="{ name: 'admin_resource_index', query: { location_id: location.id } }">Resources</b-button>
                        <b-button class="btn-block d-block" size="sm" :to="{ name: 'admin_closing_index', query: { location_id: location.id } }">Closings</b-button>
                    </b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: 'AdminLocationIndex',
        data(){
            return {
                locations: []
            }
        },
        methods: {
            getLocations: function () {
                axios.get('api/admin/locations').then((response) => {
                    this.locations = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            deleteLocation: function(locationId) {
                const deleteAlert = this.$swal({
                    icon: 'warning',
                    title: this.$i18n.t('app.admin.location.form.delete.title'),
                    html: this.$i18n.t('app.admin.location.form.delete.text'),
                    showCancelButton: true,
                    confirmButtonText: this.$i18n.t('app.admin.location.form.delete.submit_value'),
                    cancelButtonText: this.$i18n.t('app.admin.location.form.delete.cancel_value')
                });
                deleteAlert.then((response) => {
                    axios.post('api/admin/location/' + locationId + 'delete').then((response) => {
                        this.getLocations();
                    }).catch(error => {
                        console.log(error);
                    });
                });
            }
        },
        mounted() {
            this.getLocations();
        }
    }
</script>

<style scoped>

</style>
