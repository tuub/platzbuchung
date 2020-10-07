<template>
    <div>
        <div class="text-center w-25 mx-auto">
            <h1 class="text-center">{{ $t('app.admin.statistics.title') }}</h1>
            <p class="block mt-3 mb-3">{{ $t('app.admin.statistics.description') }}</p>
            <b-form-datepicker id="example-datepicker" v-model="date" class="mb-2" @input="getOccupancies()"></b-form-datepicker>
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
            <div class="text-center w-25 mx-auto">
                <h2 class="text-center">{{ $t('app.admin.statistics.occupancies.title') }}</h2>
                <p class="block mt-3 mb-3">{{ $t('app.admin.statistics.occupancies.description') }}</p>
            </div>
            <b-table-simple class="w-50 mx-auto" hover caption-top responsive>
                <b-thead head-variant="dark">
                    <b-tr>
                        <b-th>{{ $t('app.admin.statistics.occupancies.label.location') }}</b-th>
                        <b-th class="text-center">{{ $t('app.admin.statistics.occupancies.label.bookings') }}</b-th>
                        <b-th class="text-center">{{ $t('app.admin.statistics.occupancies.label.check_ins') }}</b-th>
                        <b-th class="text-center">{{ $t('app.admin.statistics.occupancies.label.occupancy_rate') }}</b-th>
                    </b-tr>
                </b-thead>
                <b-tbody>
                    <b-tr v-for="occupancy in occupancies" :key="occupancy.location">
                        <b-td>{{ occupancy.location }}</b-td>
                        <b-td class="text-center">{{ occupancy.bookings }}</b-td>
                        <b-td class="text-center">{{ occupancy.check_ins }}</b-td>
                        <b-td class="text-center">{{ occupancy.rate }} %</b-td>
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
        name: 'AdminStatisticIndex',
        components: {
            Spinner
        },
        data(){
            return {
                date: moment(),
                occupancies: [],
                isLoading: false,
            }
        },
        methods: {
            getOccupancies: function () {
                this.isLoading = true;
                this.date = this.$options.filters.formatDateForUri(this.date);
                axios.get('api/admin/statistics/occupancies?date=' + this.date).then((response) => {
                    this.occupancies = response.data;
                    this.isLoading = false;
                }).catch(error => {
                    console.log(error);
                });
            },
        },
        mounted() {
            this.getOccupancies();
        }
    }
</script>

<style scoped>

</style>
