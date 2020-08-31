<template>
    <div>
        <template v-if="isLoading">
            <button class="time-slot">
                <span class="time-slot-time font-weight-bold text-nowrap">
                    <Spinner size="small"></Spinner>
                </span><br/>
            </button>
        </template>
        <template v-else>
            <button class="time-slot"
                    :data-date="date"
                    :data-resource="resource"
                    :data-time_slot="time_slot"
                    :class="'time-slot-status-' + slotStyle"
                    :disabled="!isBookable"
                    @click="addBooking">
                    <span class="time-slot-time font-weight-bold text-nowrap">
                        {{ time_slot.start | formatTimeString }}
                        -
                        {{ time_slot.end | formatTimeString }}
                        Uhr
                    </span><br/>
                    <span class="time-slot-count"><countTo :startVal='0' :endVal='slotCount' :duration='500' :autoplay='true'></countTo></span>
            </button>
        </template>
    </div>
</template>
<style scoped>
    button:disabled, button[disabled] {
        pointer-events: none;
    }
</style>
<script>
    import Spinner from "./Spinner";
    import countTo from 'vue-count-to';
    import {store} from "../_store";
    import moment from "moment-timezone";

    export default {
        name: 'TimeSlot',
        components: {
            Spinner,
            countTo
        },
        props: {
            date: {
                type: String,
                required: true
            },
            resource: {
                type: Object,
                required: true
            },
            time_slot: {
                type: Object,
                required: true
            },
            count: {
                type: Number,
                required: true
            },
            status: {
                type: Object,
                required: false
            }
        },
        data() {
            return {
                isBooked: false,
                isLoading: false,
                myKey: 0
            }
        },
        computed: {
            isLoggedIn: function() {
                return store.state.STATUS.isLoggedIn;
            },
            isFull: function () {
                return this.slotCount === 0;
            },
            slotCount: {
                // getter
                get: function () {
                    return this.count;
                },
                // setter
                set: function (value) {
                    this.count = value;
                }
            },
            isBookable: function() {
                return Object.values(this.status).every(item => item === false);
            },
            slotStyle: function () {
                if (this.status.is_unavailable) {
                    return 'unavailable';
                }
                if (this.status.is_user_booked) {
                    return 'user-booked';
                }
                if (this.status.is_full) {
                    return 'full';
                }

                return 'available';
            }
        },
        methods: {
            addBooking: function () {
                if (this.isLoggedIn) {
                    this.$swal({
                        icon: 'info',
                        title: this.$i18n.t('app.time_grid.form.create.title'),
                        text: this.$i18n.t('app.time_grid.form.create.text'),
                        showCancelButton: true,
                        confirmButtonText: this.$i18n.t('app.time_grid.form.create.submit_value'),
                        cancelButtonText: this.$i18n.t('app.time_grid.form.create.cancel_value'),
                    }).then((result) => {
                        if (result.value) {
                            this.isLoading = true;
                            let params = {
                                date: moment(this.date).format(),
                                resource: this.resource.id,
                                time_slot: this.time_slot.id
                            };
                            this.$http({ method: 'POST', url: 'api/user/booking/add', params: params}).then((response) => {
                                if (response.data.type === 'error') {
                                    store.dispatch('ALERT_FAILURE', response.data.message);
                                } else {
                                    store.dispatch('ALERT_SUCCESS', response.data.message);
                                    this.slotCount = response.data.count;
                                    store.dispatch('FETCH_USER_BOOKINGS');
                                    this.$emit('refresh-grid');
                                }
                                this.isLoading = false;
                            });
                        }
                    });
                } else {
                    this.$router.push({name: 'login'});
                }
            },
        }
    };
</script>
