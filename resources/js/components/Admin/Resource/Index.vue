<template>
    <div>
        <b-button :to="{ name: 'admin_resource_form', query: { location_id: locationId } }">New Resource</b-button>
        <b-button :to="{ name: 'admin_location_index' }">Locations Overview</b-button>
        <b-table-simple class="w-75 mx-auto" hover caption-top responsive>
            <b-thead head-variant="dark">
                <b-tr>
                    <b-th class="text-center">Name</b-th>
                    <b-th>Short name</b-th>
                    <b-th>Location</b-th>
                    <b-th class="text-center">Capacity</b-th>
                    <b-th class="text-center">Time Slots</b-th>
                    <b-th>Actions</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for="resource in resources" :key="resource.id">
                    <b-td class="text-center" :style="{ backgroundColor: resource.color, color: resource.text_color }">{{ resource.name }}</b-td>
                    <b-td>{{ resource.short_name }}</b-td>
                    <b-td>{{ resource.location.name }}</b-td>
                    <b-td class="text-center">{{ resource.capacity }}</b-td>
                    <b-td class="text-center">{{ resource.time_slots.length }}</b-td>
                    <b-td>
                        <b-button size="sm" :to="{ name: 'admin_resource_form', query: { location_id: resource.location_id, resource_id: resource.id } }">Edit</b-button>
                        <b-button size="sm" @click="deleteResource(resource.id)">Delete</b-button>
                        <b-button size="sm" :to="{ name: 'admin_time_slot_index', query: { location_id: resource.location_id, resource_id: resource.id } }">Time Slots</b-button>
                    </b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: 'AdminResourceIndex',
        data(){
            return {
                locationId: this.$route.query.location_id ?? 0,
                resources: []
            }
        },
        methods: {
            getResources: function () {
                let params = {
                    location_id: this.locationId
                };
                axios.get('api/admin/resources?location_id=' + this.locationId).then((response) => {
                    this.resources = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            deleteResource: function(resourceId) {
                axios.post('api/admin/resource/' + resourceId + '/delete').then((response) => {
                    this.getResources();
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getResources();
        }
    }
</script>

<style scoped>

</style>
