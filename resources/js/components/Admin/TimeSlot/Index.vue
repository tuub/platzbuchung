<template>
    <div>
        <b-button :to="{ name: 'admin_time_slot_form', query: { location_id: locationId, resource_id: resourceId } }">New Time Slot</b-button>
        <b-button :to="{ name: 'admin_resource_index', query: { location_id: locationId } }">Resources Overview</b-button>
        <b-table-simple class="w-75 mx-auto" hover caption-top responsive>
            <b-thead head-variant="dark">
                <b-tr>
                    <b-th class="text-center">ID</b-th>
                    <b-th>Week Day</b-th>
                    <b-th>Start</b-th>
                    <b-th>End</b-th>
                    <b-th>Date from</b-th>
                    <b-th>Date to</b-th>
                    <b-th>Actions</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for="timeSlot in timeSlots" :key="timeSlot.id">
                    <b-td class="text-center">{{ timeSlot.id }}</b-td>
                    <b-td>{{ timeSlot.week_day | formatWeekDay }}</b-td>
                    <b-td>{{ timeSlot.start | formatTimeString }}</b-td>
                    <b-td>{{ timeSlot.end | formatTimeString }}</b-td>
                    <b-td>{{ timeSlot.date_from | formatDate }}</b-td>
                    <b-td>{{ timeSlot.date_to | formatDate }}</b-td>
                    <b-td>
                        <b-button size="sm" :to="{ name: 'admin_time_slot_form', query: { location_id: locationId, resource_id: resourceId, time_slot_id: timeSlot.id } }">Edit</b-button>
                        <b-button size="sm" @click="deleteTimeSlot(timeSlot.id)">Delete</b-button>
                    </b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: 'AdminTimeSlotIndex',
        data(){
            return {
                locationId: this.$route.query.location_id ?? 0,
                resourceId: this.$route.query.resource_id ?? 0,
                timeSlots: []
            }
        },
        methods: {
            getTimeSlots: function () {
                let params = {
                    resource_id: this.resourceId
                };
                axios.get('api/admin/time_slots?resource_id=' + this.resourceId).then((response) => {
                    this.timeSlots = response.data.time_slots;
                }).catch(error => {
                    console.log(error);
                });
            },
            deleteTimeSlot: function(timeSlotId) {
                axios.post('api/admin/time_slot/' + timeSlotId + '/delete').then((response) => {
                    this.getTimeSlots();
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getTimeSlots();
        }
    }
</script>

<style scoped>

</style>
