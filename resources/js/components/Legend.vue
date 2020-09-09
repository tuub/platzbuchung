<template>
    <b-row class="text-center justify-content-md-center" id="legend">
        <b-col col lg="1" class="time-slot-status-available p-2 text-uppercase">{{ $t('app.time_grid.legend.available') }}</b-col>
        <b-col col lg="1" class="time-slot-status-user-booked p-2 text-uppercase">{{ $t('app.time_grid.legend.user-booked') }}</b-col>
        <b-col col lg="1" class="time-slot-status-full p-2 text-uppercase">{{ $t('app.time_grid.legend.full') }}</b-col>
        <b-col col lg="1" class="time-slot-status-unavailable p-2 text-uppercase">{{ $t('app.time_grid.legend.unavailable') }}</b-col>
    </b-row>
</template>

<script>
    export default {
        name: 'Legend',
    }
</script>

<style scoped>

</style>
