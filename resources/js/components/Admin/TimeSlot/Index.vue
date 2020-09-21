<template>
    <div>
        <div class="text-center w-25 mx-auto mb-2">
            <h1 class="text-center">{{ $t('app.admin.time_slots.title') }}</h1>
            <p class="block mt-3 mb-3">{{ $t('app.admin.time_slots.description') }}</p>
            <b-button :to="{ name: 'admin_resource_index', query: { location_id: locationId } }">
                {{ $t('app.admin.time_slots.action.resource_index') }}
            </b-button>
            <b-button :to="{ name: 'admin_time_slot_form', query: { location_id: locationId, resource_id: resourceId } }">
                {{ $t('app.admin.time_slots.action.new') }}
            </b-button>
        </div>
        <b-table-simple class="w-75 mx-auto" hover caption-top responsive>
            <b-thead head-variant="dark">
                <b-tr>
                    <b-th>{{ $t('app.admin.time_slots.label.week_day') }}</b-th>
                    <b-th>{{ $t('app.admin.time_slots.label.start') }}</b-th>
                    <b-th>{{ $t('app.admin.time_slots.label.end') }}</b-th>
                    <b-th>{{ $t('app.admin.time_slots.label.date_start') }}</b-th>
                    <b-th>{{ $t('app.admin.time_slots.label.date_end') }}</b-th>
                    <b-th>{{ $t('app.admin.time_slots.label.actions') }}</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for="timeSlot in timeSlots" :key="timeSlot.id">
                    <b-td>{{ timeSlot.week_day | formatWeekDay }}</b-td>
                    <b-td>{{ timeSlot.start | formatTimeString }}</b-td>
                    <b-td>{{ timeSlot.end | formatTimeString }}</b-td>
                    <b-td>{{ timeSlot.date_from | formatDate }}</b-td>
                    <b-td>{{ timeSlot.date_to | formatDate }}</b-td>
                    <b-td>
                        <b-button size="sm" :to="{ name: 'admin_time_slot_form', query: { location_id: locationId, resource_id: resourceId, time_slot_id: timeSlot.id } }">
                            {{ $t('app.admin.time_slots.action.edit') }}
                        </b-button>
                        <b-button size="sm" @click="deleteTimeSlot(timeSlot.id)">
                            {{ $t('app.admin.time_slots.action.delete') }}
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
                    this.timeSlots = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            deleteTimeSlot: function(timeSlotId) {
                let dialog = this.$i18n.t('app.admin.time_slots.form.delete.message');
                if (confirm(dialog)) {
                    axios.post('api/admin/time_slot/' + timeSlotId + '/delete').then((response) => {
                        this.getTimeSlots();
                    }).catch(error => {
                        console.log(error);
                    });
                }
            }
        },
        mounted() {
            this.getTimeSlots();
        }
    }
</script>

<style scoped>

</style>
