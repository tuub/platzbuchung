<template>
    <div>
        <h1 class="text-center">{{ $t('app.home.title') }}</h1>
        <p class="block mt-3 mb-3">{{ $t('app.home.intro') }}</p>
        <time-grid :dates="dates"
                   :resources="resources"
                   :time_slots="time_slots"
                   :grid_data="grid_data"
                   :offset="0">
        </time-grid>
    </div>
</template>

<script>
    import TimeGrid from "./TimeGrid";
    import {store} from "../_store";

    export default {
        name: 'Home',
        components: {
            TimeGrid
        },
        data() {
            return {
                grid_data: {},
                dates: [],
                resources: [],
                time_slots: [],
                prev_button: true,
                next_button: true
            }
        },
        computed: {

        },
        methods: {
            logout: function () {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push({name: 'login'})
                    })
            },

        },

    }
</script>

<style scoped>

</style>
