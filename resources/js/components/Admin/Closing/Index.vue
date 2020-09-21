<template>
    <div>
        <div class="text-center w-25 mx-auto mb-2">
            <h1 class="text-center">{{ $t('app.admin.closings.title') }}</h1>
            <p class="block mt-3 mb-3">{{ $t('app.admin.closings.description') }}</p>
            <b-button :to="{ name: 'admin_location_index' }">
                {{ $t('app.admin.locations.title') }}
            </b-button>
            <b-button :to="{ name: 'admin_closing_form', query: { location_id: locationId } }">
                {{ $t('app.admin.closings.action.new') }}
            </b-button>
        </div>
        <b-table-simple class="w-75 mx-auto" hover caption-top responsive>
            <b-thead head-variant="dark">
                <b-tr>
                    <b-th>{{ $t('app.admin.closings.label.date_start') }}</b-th>
                    <b-th>{{ $t('app.admin.closings.label.date_end') }}</b-th>
                    <b-th>{{ $t('app.admin.closings.label.description') }}</b-th>
                    <b-th>{{ $t('app.admin.closings.label.actions') }}</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for="closing in closings" :key="closing.id">
                    <b-td>{{ closing.date_start | formatDateWithWeekday }}</b-td>
                    <b-td>{{ closing.date_end | formatDateWithWeekday }}</b-td>
                    <b-td>{{ closing.description }}</b-td>
                    <b-td>
                        <b-button size="sm" :to="{ name: 'admin_closing_form', query: { location_id: closing.location_id, closing_id: closing.id } }">
                            {{ $t('app.admin.closings.action.edit') }}
                        </b-button>
                        <b-button size="sm" @click="deleteClosing(closing.id)">
                            {{ $t('app.admin.closings.action.delete') }}
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
                let dialog = this.$i18n.t('app.admin.closings.form.delete.message');
                if (confirm(dialog)) {
                    axios.post('api/admin/location/closing/' + closingId + '/delete').then((response) => {
                        this.getClosings();
                    }).catch(error => {
                        console.log(error);
                    });
                }
            }
        },
        mounted() {
            this.getClosings();
        }
    }
</script>

<style scoped>

</style>
