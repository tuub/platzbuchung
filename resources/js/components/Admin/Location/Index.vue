<template>
    <div>
        <div class="text-center w-25 mx-auto mb-2">
            <h1 class="text-center">{{ $t('app.admin.locations.title') }}</h1>
            <p class="block mt-3 mb-3">{{ $t('app.admin.locations.description') }}</p>
            <b-button :to="{ name: 'admin_index' }">{{ $t('app.admin.locations.action.admin_index') }}</b-button>
            <b-button :to="{ name: 'admin_location_form' }">{{ $t('app.admin.locations.action.new') }}</b-button>
        </div>
        <b-table-simple class="w-75 mx-auto" hover caption-top responsive>
            <b-thead head-variant="dark">
                <b-tr>
                    <b-th>{{ $t('app.admin.locations.label.uid') }}</b-th>
                    <b-th>{{ $t('app.admin.locations.label.name') }}</b-th>
                    <b-th>{{ $t('app.admin.locations.label.address') }}</b-th>
                    <b-th>{{ $t('app.admin.locations.label.email') }}</b-th>
                    <b-th>{{ $t('app.admin.locations.label.logo') }}</b-th>
                    <b-th>{{ $t('app.admin.locations.label.image') }}</b-th>
                    <b-th>{{ $t('app.admin.locations.label.coordinates') }}</b-th>
                    <b-th>{{ $t('app.admin.locations.label.days_in_advance') }}</b-th>
                    <b-th>{{ $t('app.admin.locations.label.user_booking_quota') }}</b-th>
                    <b-th>{{ $t('app.admin.locations.label.actions') }}</b-th>
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
                        <b-button class="btn-block d-block" size="sm" :to="{ name: 'admin_location_form', query: { location_id: location.id } }">
                            {{ $t('app.admin.locations.action.edit') }}
                        </b-button>
                        <b-button class="btn-block d-block" size="sm" @click="deleteLocation(location.id)">
                            {{ $t('app.admin.locations.action.delete') }}
                        </b-button>
                        <b-button class="btn-block d-block" size="sm" :to="{ name: 'admin_resource_index', query: { location_id: location.id } }">
                            {{ $t('app.admin.locations.action.resources') }}
                        </b-button>
                        <b-button class="btn-block d-block" size="sm" :to="{ name: 'admin_closing_index', query: { location_id: location.id } }">
                            {{ $t('app.admin.locations.action.closings') }}
                        </b-button>
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
                let dialog = this.$i18n.t('app.admin.locations.form.delete.message');
                if (confirm(dialog)) {
                    axios.post('api/admin/location/' + locationId + 'delete').then((response) => {
                        this.getLocations();
                    }).catch(error => {
                        console.log(error);
                    });
                };
            }
        },
        mounted() {
            this.getLocations();
        }
    }
</script>

<style scoped>

</style>
