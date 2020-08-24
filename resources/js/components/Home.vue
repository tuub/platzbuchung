<template>
    <div>
        <h1 class="text-center">{{ $t('app.home.title') }}</h1>
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
                location: null,
                grid_data: {},
                dates: [],
                resources: [],
                time_slots: [],
                prev_button: true,
                next_button: true
            }
        },
        methods: {
            logout: function () {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push({name: 'login'})
                    })
            },
        }
    }
</script>

<style scoped>

</style>
