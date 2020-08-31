<template>
    <div class="text-center">
        <h1 class="text-center">{{ $t('app.locations.title') }}</h1>
        <p class="block mt-3 mb-3">{{ $t('app.locations.intro') }}</p>
        <b-container>
        <b-row>
            <b-col v-for="location in locations" :key="location.id">
                <b-card
                    :title=location.name
                    :img-src=location.image_uri
                    :img-alt=location.name
                    img-top
                    tag="article"
                    style="max-width: 20rem;"
                    class="mb-2"
                >
                    <b-card-text>
                        {{ location.address }}
                    </b-card-text>

                    <b-button :to="{ name: 'home', params: { location: location.uid } }" variant="primary" @click="persistLocation(location.uid)">Plätze buchen</b-button>

                </b-card>
            </b-col>
        </b-row>
        </b-container>
    </div>
</template>

<script>
    import axios from "axios";
    import {store} from "../_store";

    export default {
        name: "Locations",
        data() {
            return {
                locations: []
            }
        },
        methods: {
            getLocations: function () {
                axios.get('api/admin/locations').then((response) => {
                    this.locations = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            persistLocation: function (location) {
                store.dispatch('SAVE_LOCATION', {location: location});
            }
        },
        mounted() {
            this.getLocations();
        }
    }
</script>

<style scoped>

</style>
