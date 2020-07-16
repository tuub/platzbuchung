<template>
    <div>
        <b-row class="text-center" align-v="center">
            <b-col>
                <p class="lead">{{ introText }}</p>
            </b-col>
        </b-row>

        <b-row class="text-center" align-v="center">
            <b-col>
                <div class="mt-3 mb-3">
                    <b-button-group size="lg">
                        <b-button href="#" variant="dark" @click.prevent="getGridData(-1)" :disabled="!prev_button">{{ $t('app.time_grid.pagination.previous') }}</b-button>
                        <b-button href="#" variant="dark" @click.prevent="getGridData(0)" :disabled="!today_button">{{ $t('app.time_grid.pagination.now') }}</b-button>
                        <b-button href="#" variant="dark" @click.prevent="getGridData(+1)" :disabled="!next_button">{{ $t('app.time_grid.pagination.next') }}</b-button>
                    </b-button-group>
                </div>
            </b-col>
        </b-row>

        <b-table-simple small responsive borderless>
            <b-thead>
                <b-tr>
                    <b-th></b-th>
                    <b-th class="text-center h4" v-for="date in dates" v-bind:key="date">
                        {{ date | formatDate }}
                    </b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for="resource in resources" v-bind:key="resource.id">
                    <b-td>
                        <div class="text-center text-uppercase text-base p-3">{{ resource.name }}</div>
                    </b-td>
                    <b-td class="text-center" v-for="date in dates" v-bind:key="date">
                        <template v-for="grid_item in grid_data">
                            <template v-if="grid_item.date === date && grid_item.resource === resource.id">
                                <time-slot :date="grid_item.date"
                                           :resource="resource"
                                           :time_slot="grid_item.time_slot"
                                           :count="grid_item.count"
                                           :status="grid_item.status"
                                           @refresh-grid="refresh">
                                </time-slot>
                            </template>
                        </template>
                    </b-td>
                </b-tr>
            </b-tbody>
        </b-table-simple>
    </div>
</template>

<script>
    import Spinner from "./Spinner";
    import TimeSlot from "./TimeSlot";
    import {store} from "../_store";

    export default {
        name: "TimeGrid",
        components: {
            Spinner,
            TimeSlot
        },
        props: {
            grid_data: {
                required: true
            },
            dates: {
                type: Array,
                required: true
            },
            resources: {
                type: Array,
                required: true
            },
            time_slots: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                current_offset: 0,
                isLoading: false,
                user_bookings: [],
                today_button: true,
                prev_button: true,
                next_button: true,
            }
        },
        computed: {
            isLoggedIn: function () {
                return store.state.STATUS.isLoggedIn;
            },
            introText: function () {
                return this.$i18n.t('app.time_grid.intro', {user_booking_quota: process.env.MIX_USER_BOOKING_QUOTA, display_days_in_advance: process.env.MIX_DISPLAY_DAYS_IN_ADVANCE});
            }
        },
        methods: {
            async refresh() {
                Object.assign(this.user_bookings, await this.getUserBookings());
                Object.assign(this.grid_data, await this.getGridData(this.current_offset, true));
            },
            async getGridData(offset, refresh = false) {

                if (refresh) {
                    this.current_offset = offset;
                } else {
                    this.current_offset = offset === 0 ? offset : this.current_offset += offset;
                }

                if (this.current_offset >= 0) {
                    let params = {
                        offset: this.current_offset
                    };

                    await this.$http({ method: 'GET', url: 'grid', params: params}).then(response => {
                        let dates = response.data.dates;
                        let dates_count = (typeof dates == 'object') ? Object.keys(dates).length : 0;

                        this.today_button = this.current_offset !== 0;
                        this.prev_button = response.data.has_previous;
                        this.next_button = response.data.has_next;

                        if (dates_count > 0) {
                            this.dates = response.data.dates;
                            this.resources = response.data.resources;
                            this.time_slots = response.data.time_slots;
                            this.grid_data = response.data.grid_data;
                        } else {
                            this.dates = response.data.dates;
                        }
                    });
                }  else {
                    this.current_offset = 0;
                }
            },
            async getUserBookings() {
                if (this.isLoggedIn) {
                    this.user_bookings = store.state.BOOKINGS;
                } else {
                    this.user_bookings = [];
                }
            },
        },
        beforeMount() {
            this.getGridData(this.current_offset);
            this.getUserBookings();
        }
    }
</script>

<style scoped>

</style>
