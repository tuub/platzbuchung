<template>
    <div class="text-center">
        <h1>{{ $t('app.bookings.title') }}</h1>
        <p class="lead">{{ $t('app.bookings.intro') }}</p>
        <template v-if="bookings.length > 0">
            <b-table-simple class="w-50 mx-auto" hover small caption-top responsive v-if="bookings.length > 0">
                <b-thead head-variant="dark">
                    <b-tr>
                        <b-th>{{ $t('app.bookings.label.date') }}</b-th>
                        <b-th>{{ $t('app.bookings.label.resource') }}</b-th>
                        <b-th>{{ $t('app.bookings.label.start') }}</b-th>
                        <b-th>{{ $t('app.bookings.label.end') }}</b-th>
                        <b-th></b-th>
                        <b-th></b-th>
                    </b-tr>
                </b-thead>
                <b-tbody>
                    <b-tr v-for="booking in bookings" v-bind:key="booking.id">
                        <b-td>{{ booking.date | formatDate }}</b-td>
                        <b-td>{{ booking.resource.name }}</b-td>
                        <b-td>{{ booking.start | formatTime }}</b-td>
                        <b-td>{{ booking.end | formatTime }}</b-td>
                        <b-td>
                            <b-link>
                                <a class="cursor-pointer" @click="sendBookingConfirmation(booking.id)">{{ $t('app.bookings.action.resend') }}</a>
                            </b-link>
                        </b-td>
                        <b-td>
                            <template v-if="booking.is_active_and_in_progress">
                                <i>{{ $t('app.bookings.status.in_progress') }}</i>
                            </template>
                            <template v-else>
                                <b-link>
                                    <a class="underline cursor-pointer" @click="removeBooking(booking.id)">{{ $t('app.bookings.action.delete') }}</a>
                                </b-link>
                            </template>
                        </b-td>
                    </b-tr>
                </b-tbody>
            </b-table-simple>
        </template>
        <template v-else>
            {{ $t('app.bookings.status.no_bookings') }}
        </template>
    </div>
</template>

<script>
    import {store} from "../_store";

    export default {
        name: "Bookings",
        computed: {
            bookings: function () {
                return store.state.BOOKINGS;
            }
        },
        methods: {
            async getUserBookings() {
                store.dispatch('FETCH_USER_BOOKINGS').then(() => {
                    this.user_bookings = store.state.BOOKINGS;
                });
            },
            removeBooking: function (id) {
                let params = {
                    id: id
                };

                this.$swal({
                    icon: 'warning',
                    title: this.$i18n.t('app.bookings.form.delete.title'),
                    text: this.$i18n.t('app.bookings.form.delete.text'),
                    showCancelButton: true,
                    confirmButtonText: this.$i18n.t('app.bookings.form.delete.submit_value'),
                    cancelButtonText: this.$i18n.t('app.bookings.form.delete.cancel_value')
                }).then((result) => {
                    if (result.value) {
                        this.$http.post('api/user/booking/delete', params).then((response) => {
                            store.dispatch('FETCH_USER_BOOKINGS');
                            store.dispatch('TOAST_SUCCESS', this.$i18n.t('app.bookings.status.delete_success'));
                        });
                    }
                });
            },
            sendBookingConfirmation: function (id) {
                let params = {
                    id: id
                };

                this.$http.post('api/user/send_confirmation', params).then((response) => {
                    store.dispatch('TOAST_SUCCESS', this.$i18n.t('app.bookings.status.resend_success'))
                });
            }

        },
        beforeMount() {
            this.getUserBookings();
        }
    }
</script>

<style scoped>

</style>
