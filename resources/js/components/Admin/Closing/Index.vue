<template>
    <div>
        <b-button :to="{ name: 'admin_closing_form', query: { location_id: locationId } }">New Closing</b-button>
        <b-button :to="{ name: 'admin_location_index' }">Locations Overview</b-button>
        <b-table-simple class="w-75 mx-auto" hover caption-top responsive>
            <b-thead head-variant="dark">
                <b-tr>
                    <b-th>From Date</b-th>
                    <b-th>To Date</b-th>
                    <b-th>Description</b-th>
                    <b-th>Actions</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for="closing in closings" :key="closing.id">
                    <b-td>{{ closing.date_start | formatDateWithWeekday }}</b-td>
                    <b-td>{{ closing.date_end | formatDateWithWeekday }}</b-td>
                    <b-td>{{ closing.description }}</b-td>
                    <b-td>
                        <b-button size="sm" :to="{ name: 'admin_closing_form', query: { location_id: closing.location_id, closing_id: closing.id } }">Edit</b-button>
                        <b-button size="sm" @click="deleteClosing(closing.id)">Delete</b-button>
                    </b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: 'AdminClosingIndex',
        data(){
            return {
                locationId: this.$route.query.location_id ?? 0,
                closings: []
            }
        },
        methods: {
            getClosings: function () {
                let params = {
                    location_id: this.locationId
                };
                axios.get('api/admin/location/' + this.locationId + '/closings').then((response) => {
                    this.closings = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            deleteClosing: function(closingId) {
                axios.post('api/admin/location/closing/' + closingId + '/delete').then((response) => {
                    this.getClosings();
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getClosings();
        }
    }
</script>

<style scoped>

</style>
