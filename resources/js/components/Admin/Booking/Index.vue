<template>
    <div>
        <div class="text-center w-25 mx-auto">
            <h1 class="text-center">{{ $t('app.admin.bookings.title') }}</h1>
            <p class="block mt-3 mb-3">{{ $t('app.admin.bookings.description') }}</p>
            <b-form>
                <b-form-group id="barcode-field" :label="$t('app.admin.bookings.form.index.barcode.label')" label-for="barcode" class="font-weight-bold text-uppercase">
                    <b-input-group
                        :size="lg"
                        class="mb-3">
                        <b-form-input id="barcode" v-model="barcode" type="text"required :placeholder="$t('app.admin.bookings.form.index.barcode.placeholder')"></b-form-input>
                        <b-input-group-append>
                            <b-button type="button" @click="getBookings" class="text-uppercase" variant="success">{{ $t('app.admin.bookings.form.index.submit_value') }}</b-button>
                        </b-input-group-append>
                    </b-input-group>

                </b-form-group>
            </b-form>
        </div>
        <template v-if="isLoading">
            <b-row class="text-center" align-v="center">
                <b-col>
                    <div class="mt-3 mb-3">
                        <Spinner size="big"></Spinner>
                    </div>
                </b-col>
            </b-row>
        </template>
        <template v-else>
            <b-table-simple class="w-75 mx-auto" hover caption-top responsive>
                <b-thead head-variant="dark">
                    <b-tr>
                        <b-th>{{ $t('app.admin.bookings.label.date') }}</b-th>
                        <b-th>{{ $t('app.admin.bookings.label.location') }}</b-th>
                        <b-th>{{ $t('app.admin.bookings.label.resource') }}</b-th>
                        <b-th>{{ $t('app.admin.bookings.label.start') }}</b-th>
                        <b-th>{{ $t('app.admin.bookings.label.end') }}</b-th>
                        <b-th class="text-center">{{ $t('app.admin.bookings.label.status_active') }}</b-th>
                        <b-th class="text-center">{{ $t('app.admin.bookings.label.status_deleted_by_user') }}</b-th>
                        <b-th class="text-center">{{ $t('app.admin.bookings.label.status_check_in') }}</b-th>
                        <b-th class="text-center">{{ $t('app.admin.bookings.label.status_check_out') }}</b-th>
                    </b-tr>
                </b-thead>
                <b-tbody>
                    <b-tr v-for="booking in bookings" :key="booking.id">
                        <b-td>{{ booking.date | formatDateWithWeekday }}</b-td>
                        <b-td>{{ booking.resource.location.name }}</b-td>
                        <b-td>{{ booking.resource.name }}</b-td>
                        <b-td>{{ booking.start | formatDateTimeString }}</b-td>
                        <b-td>{{ booking.end | formatDateTimeString }}</b-td>
                        <b-td class="text-center">
                            <span class="text-success icon" v-if="isActiveBooking(booking)">&check;</span>
                            <span class="text-danger icon" v-else>&times;</span>
                        </b-td>
                        <b-td class="text-center">
                            <span class="text-success icon" v-if="isDeletedBooking(booking)" :title="getDeletionDateTime(booking) | formatDate">&check;</span>
                            <span class="text-danger icon" v-else>&times;</span>
                        </b-td>
                        <b-td class="text-center">
                            <span class="text-success icon" v-if="isCheckedInBooking(booking)">&check;</span>
                            <span class="text-danger icon" v-else>&times;</span>
                        </b-td>
                        <b-td class="text-center">
                            <span class="text-success icon" v-if="isCheckedOutBooking(booking)">&check;</span>
                            <span class="text-danger icon" v-else>&times;</span>
                        </b-td>
                    </b-tr>
                </b-tbody>
            </b-table-simple>
        </template>
    </div>
</template>

<script>
    import axios from "axios";
    import moment from "moment";
    import Spinner from "../../Spinner";

    export default {
        name: 'AdminBookingIndex',
        components: {
            Spinner
        },
        data(){
            return {
                barcode: '',
                bookings: [],
                isLoading: false,
            }
        },
        methods: {
            getBookings: function () {
                this.isLoading = true;
                let params = {
                    barcode: this.barcode
                };
                axios.get('api/admin/bookings/' + this.barcode).then((response) => {
                    this.bookings = response.data;
                    this.isLoading = false;
                }).catch(error => {
                    console.log(error);
                });
            },
            isActiveBooking: function(booking) {
                return moment(booking.end).isAfter(moment.now());
            },
            isDeletedBooking: function(booking) {
                return booking.deleted_by_user === 1;
            },
            getDeletionDateTime: function(booking) {
                if (this.isDeletedBooking(booking)) {
                    return booking.deleted_at;
                }
            },
            isCheckedInBooking: function (booking) {
                return booking.check_in !== null;
            },
            isCheckedOutBooking: function (booking) {
                return booking.check_in !== null && booking.check_in.check_out !== null;
            },
        }
    }
</script>

<style scoped>

</style>
