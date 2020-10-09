<template>
    <div>
        <div class="text-center w-25 mx-auto">
            <h1 class="text-center">{{ $t('app.admin.permissions.title') }}</h1>
            <p class="block mt-3 mb-3">{{ $t('app.admin.permissions.description') }}</p>
            <b-button :to="{ name: 'admin_index' }">{{ $t('app.admin.locations.action.admin_index') }}</b-button>
            <b-form>
                <b-form-group id="barcode-field" :label="$t('app.admin.permissions.form.index.barcode.label')" label-for="barcode" class="font-weight-bold text-uppercase">
                    <b-input-group
                        :size="lg"
                        class="mb-3">
                        <b-form-input id="barcode" v-model="barcode" type="text"required :placeholder="$t('app.admin.permissions.form.index.barcode.placeholder')"></b-form-input>
                        <b-input-group-append>
                            <b-button type="button" @click="addPermission" class="text-uppercase" variant="success">{{ $t('app.admin.permissions.form.index.submit_value') }}</b-button>
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
                        <b-th>{{ $t('app.admin.permissions.label.username') }}</b-th>
                        <b-th>{{ $t('app.admin.permissions.label.barcode') }}</b-th>
                        <b-th class="text-center">{{ $t('app.admin.permissions.label.actions') }}</b-th>
                    </b-tr>
                </b-thead>
                <b-tbody>
                    <b-tr v-for="permission in permissions" :key="permission.id">
                        <b-td>{{ permission.id }}{{ permission.username }}</b-td>
                        <b-td>{{ permission.barcode || 'N/A' }}</b-td>
                        <b-td>
                            {{ userName }}
                            <b-button class="btn-block d-block" size="sm" @click="deletePermission(permission.barcode)" v-if="permission.barcode !== userBarcode">
                                {{ $t('app.admin.permissions.action.delete') }}
                            </b-button>
                        </b-td>
                    </b-tr>
                </b-tbody>
            </b-table-simple>
        </template>
    </div>
</template>

<script>
    import axios from "axios";
    import {store} from "../../../_store";
    import Spinner from "../../Spinner";

    export default {
        name: 'AdminPermissionIndex',
        components: {
            Spinner
        },
        data(){
            return {
                permissions: [],
                isLoading: false,
            }
        },
        computed: {
            userBarcode: function () {
                return store.state.USER.barcode;
            }
        },
        methods: {
            getPermissions: function () {
                this.isLoading = true;
                axios.get('api/admin/permissions').then((response) => {
                    this.permissions = response.data;
                    this.isLoading = false;
                }).catch(error => {
                    console.log(error);
                });
            },
            addPermission: function (e) {
                let params = {};
                for(let element of e.target.form) {
                    if (element.id) {
                        params[element.id] = element.value;
                    }
                }

                axios.post('api/admin/permission/save', params).then((response) => {
                    console.log(response.data);
                    this.getPermissions();
                }).catch(error => {
                    console.log(error);
                });
            },
            deletePermission: function(barcode) {
                let dialog = this.$i18n.t('app.admin.permissions.form.delete.message');
                if (confirm(dialog)) {
                    axios.post('api/admin/permission/' + barcode + '/delete').then((response) => {
                        this.getPermissions();
                    }).catch(error => {
                        console.log(error);
                    });
                };
            }
        },
        mounted() {
            this.getPermissions();
        }
    }
</script>

<style scoped>

</style>
