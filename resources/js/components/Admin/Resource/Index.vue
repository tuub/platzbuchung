<template>
    <div>
        <div class="text-center w-25 mx-auto mb-2">
            <h1 class="text-center">{{ $t('app.admin.resources.title') }}</h1>
            <p class="block mt-3 mb-3">{{ $t('app.admin.resources.description') }}</p>
            <b-button :to="{ name: 'admin_location_index' }">
                {{ $t('app.admin.resources.action.location_index') }}
            </b-button>
            <b-button :to="{ name: 'admin_resource_form', query: { location_id: locationId } }">
                {{ $t('app.admin.resources.action.new') }}
            </b-button>
        </div>
        <b-table-simple class="w-75 mx-auto" hover caption-top responsive v-sortable>
            <b-thead head-variant="dark">
                <b-tr>
                    <b-th class="text-center">{{ $t('app.admin.resources.label.name') }}</b-th>
                    <b-th>{{ $t('app.admin.resources.label.short_name') }}</b-th>
                    <b-th>{{ $t('app.admin.resources.label.location') }}</b-th>
                    <b-th class="text-center">{{ $t('app.admin.resources.label.capacity') }}</b-th>
                    <b-th class="text-center">{{ $t('app.admin.resources.label.time_slots') }}</b-th>
                    <b-th>{{ $t('app.admin.resources.label.actions') }}</b-th>
                </b-tr>
            </b-thead>
            <b-tbody>
                <b-tr v-for="resource in resources" :key="resource.id">
                    <b-td class="text-center" :style="{ backgroundColor: resource.color, color: resource.text_color }">{{ resource.name }}</b-td>
                    <b-td>{{ resource.short_name }}</b-td>
                    <b-td>{{ resource.location.name }}</b-td>
                    <b-td class="text-center">{{ resource.capacity }}</b-td>
                    <b-td class="text-center">{{ resource.time_slots.length }}</b-td>
                    <b-td>
                        <b-button size="sm" :to="{ name: 'admin_resource_form', query: { location_id: resource.location_id, resource_id: resource.id } }">
                            {{ $t('app.admin.resources.action.edit') }}
                        </b-button>
                        <b-button size="sm" @click="deleteResource(resource.id)">
                            {{ $t('app.admin.resources.action.delete') }}
                        </b-button>
                        <b-button size="sm" :to="{ name: 'admin_time_slot_index', query: { location_id: resource.location_id, resource_id: resource.id } }">
                            {{ $t('app.admin.resources.action.time_slot_index') }}
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
        name: 'AdminResourceIndex',
        data(){
            return {
                locationId: this.$route.query.location_id ?? 0,
                resources: []
            }
        },
        methods: {
            getResources: function () {
                let params = {
                    location_id: this.locationId
                };
                axios.get('api/admin/resources?location_id=' + this.locationId).then((response) => {
                    this.resources = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            deleteResource: function(resourceId) {
                let dialog = this.$i18n.t('app.admin.resources.form.delete.message');
                if (confirm(dialog)) {
                    axios.post('api/admin/resource/' + resourceId + '/delete').then((response) => {
                        this.getResources();
                    }).catch(error => {
                        console.log(error);
                    });
                }
            }
        },
        mounted() {
            this.getResources();
        }
    }
</script>

<style scoped>

</style>
