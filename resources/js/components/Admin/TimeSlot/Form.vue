<template>
    <div class="w-25 mx-auto">
        <h1>{{ $t('app.admin.time_slots.form.edit.title') }}</h1>
        <b-form>
            <b-form-group id="week_day-field" :label="$t('app.admin.time_slots.form.fields.week_day.label')" label-for="week_day" class="font-weight-bold text-uppercase">
                <b-form-radio-group
                    id="week_day"
                    v-model="timeSlot.week_day"
                    :options="weekDays"
                    name="week_day"
                    class="font-weight-normal"
                ></b-form-radio-group>
            </b-form-group>
            <b-form-group id="start-field" :label="$t('app.admin.time_slots.form.fields.start.label')" label-for="start" class="font-weight-bold text-uppercase">
                <b-form-timepicker id="start" name="start" v-model="timeSlot.start"  minutes-step="30" close-button reset-button></b-form-timepicker>
            </b-form-group>
            <b-form-group id="end-field" :label="$t('app.admin.time_slots.form.fields.end.label')" label-for="end" class="font-weight-bold text-uppercase">
                <b-form-timepicker id="end" name="end" v-model="timeSlot.end"  minutes-step="30" close-button reset-button></b-form-timepicker>
            </b-form-group>
            <b-form-group id="date_from-field" :label="$t('app.admin.time_slots.form.fields.date_from.label')" label-for="date_from" class="font-weight-bold text-uppercase">
                <b-form-datepicker id="date_from" name="date_from" v-model="timeSlot.date_from" close-button reset-button></b-form-datepicker>
            </b-form-group>
            <b-form-group id="date_to-field" :label="$t('app.admin.time_slots.form.fields.date_to.label')" label-for="date_to" class="font-weight-bold text-uppercase">
                <b-form-datepicker id="date_to" name="date_to" v-model="timeSlot.date_to" close-button reset-button></b-form-datepicker>
            </b-form-group>

            <b-button type="button" @click="storeTimeSlot" class="text-uppercase" variant="success" :disabled="submitted" v-text="submitted ?
                $t('app.admin.time_slots.form.submit_progress') :
                $t('app.admin.time_slots.form.submit_value')">
            </b-button>
            <b-button type="button" @click="closeForm" class="text-uppercase" variant="danger" :disabled="submitted" v-text="$t('app.admin.time_slots.form.cancel_value')"></b-button>
        </b-form>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: 'AdminTimeSlotForm',
        data(){
            return {
                locationId: this.$route.query.location_id ?? 0,
                resourceId: this.$route.query.resource_id ?? 0,
                timeSlotId: this.$route.query.time_slot_id ?? 0,
                timeSlot: {},
                submitted: false,
                weekDays: [
                    { value: 1, text: 'MONDAY' },
                    { value: 2, text: 'TUESDAY' },
                    { value: 3, text: 'WEDNESDAY' },
                    { value: 4, text: 'THURSDAY' },
                    { value: 5, text: 'FRIDAY' },
                    { value: 6, text: 'SATURDAY' },
                    { value: 0, text: 'SUNDAY' },
                ]
            }
        },
        methods: {
            fetchTimeSlot: function () {
                axios.get('api/admin/time_slot/' + this.timeSlotId).then((response) => {
                    this.timeSlot = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            storeTimeSlot: function (e) {
                let action = this.timeSlotId === 0 ? 'api/admin/time_slot/save' : 'api/admin/time_slot/' + this.timeSlotId + '/update';
                let params = {
                    resource_id: this.resourceId,
                    name: this.timeSlot.name,
                    week_day: this.timeSlot.week_day,
                    start: this.timeSlot.start,
                    end: this.timeSlot.end,
                    date_from: this.timeSlot.date_from,
                    date_to: this.timeSlot.date_to,
                };

                axios.post(action, params).then((response) => {
                    this.$router.push({'name': 'admin_time_slot_index', 'query': { location_id: this.locationId, resource_id: this.resourceId } });
                }).catch(error => {
                    console.log(error);
                });
            },
            closeForm: function () {
                let dialog = this.$i18n.t('app.admin.time_slots.form.cancel_message');
                if (confirm(dialog)) {
                    this.$router.push({'name': 'admin_time_slot_index', query: { location_id: this.locationId, resource_id: this.resourceId }});
                };
            }
        },
        mounted() {
            if (this.timeSlotId > 0) {
                this.fetchTimeSlot();
            }
        }
    }
</script>

<style scoped>

</style>
