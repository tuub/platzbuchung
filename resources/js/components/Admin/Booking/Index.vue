<template>
    <div>
        <div class="text-center w-25 mx-auto">
            <b-form>
                <b-form-group id="barcode-field" :label="barcodeLabel" label-for="barcode" class="font-weight-bold text-uppercase">
                    <b-input-group
                        :size="lg"
                        class="mb-3">
                        <b-form-input id="barcode" v-model="barcode" type="text"required placeholder=""></b-form-input>
                        <b-input-group-append>
                            <b-button type="button" @click="getBookings" class="text-uppercase" variant="success">{{ $t('app.admin.bookings.form.index.submit_value') }}</b-button>
                        </b-input-group-append>
                    </b-input-group>

                </b-form-group>
            </b-form>
        </div>
        <b-table-simple class="w-75 mx-auto" hover caption-top responsive>
            <b-thead head-variant="dark">
                <b-tr>
                    <b-th>{{ $t('app.admin.bookings.label.date') }}</b-th>
                    <b-th>{{ $t('app.admin.bookings.label.location') }}</b-th>
                    <b-th>{{ $t('app.admin.bookings.label.resource') }}</b-th>
                    <b-th>{{ $t('app.admin.bookings.label.start') }}</b-th>
                    <b-th>{{ $t('app.admin.bookings.label.end') }}</b-th>
                    <b-th>{{ $t('app.admin.bookings.label.status') }}</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for="booking in bookings" :key="booking.id">
                    <b-td>{{ booking.date | formatDateWithWeekday }}</b-td>
                    <b-td>{{ booking.resource.location.name }}</b-td>
                    <b-td>{{ booking.resource.name }}</b-td>
                    <b-td>{{ booking.start | formatDateTimeString }}</b-td>
                    <b-td>{{ booking.end | formatDateTimeString }}</b-td>
                    <b-td>{{ getBookingStatus(booking) }}</b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
    </div>
</template>

<script>
    import axios from "axios";
    import moment from "moment";

    export default {
        name: 'AdminBookingIndex',
        data(){
            return {
                barcode: '',
                bookings: []
            }
        },
        methods: {
            getBookings: function () {
                let params = {
                    barcode: this.barcode
                };
                axios.get('api/admin/bookings/' + this.barcode).then((response) => {
                    this.bookings = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            getBookingStatus: function(booking) {
                let status = '';
                if (moment(booking.end).isBefore(moment.now())) {
                    status = this.$i18n.t('app.admin.bookings.status.expired');
                } else if (booking.deleted_by_user === 1) {
                    status = this.$i18n.t('app.admin.bookings.status.deleted_by_user', {
                        date: this.$options.filters.formatDate(booking.deleted_at),
                        time: this.$options.filters.formatDateTimeString(booking.deleted_at)
                    });
                } else {
                    status = this.$i18n.t('app.admin.bookings.status.active');
                }

                return status;
            }
        }
    }
</script>

<style scoped>

</style>
